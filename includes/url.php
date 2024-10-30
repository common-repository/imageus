<?php

function imgus_is_activated() {
  return get_option('imgus_imageus_active') == "true";
}


function imgus_get_authorised_hosts() {
  $hosts = htmlspecialchars(get_option('imgus_imageus_hosts'), ENT_QUOTES, 'UTF-8');
  return array_filter(array_map('trim', explode(',', $hosts)));
}

function imgus_get_source() {
  return trim(get_option('imgus_imageus_source'));
}

function imgus_apply_imageus_urls($the_content) {
  $hosts = join('|', array_map(function($host) {
    return preg_quote($host, '/');
  }, imgus_get_authorised_hosts()));

  $the_content = preg_replace_callback('/<img[\s\r\n]+.*?>/is', function($matches) use ($hosts) {
    return imgus_process_image_fragment($matches[0], $hosts);
  }, $the_content);

  $the_content = preg_replace_callback("/<[^>]*?\sstyle=['\"][^>]*?background(-image)?:.*?url\(\s*.*?\s*\);?.*?['\"].*?>/ismS", function($matches)  use ($hosts) {
    return imgus_process_background_fragment($matches[0], $hosts);
  }, $the_content);

  return $the_content;
}

function imgus_process_background_fragment($fragment, $hosts) {
  if (!preg_match("/$hosts/", $fragment)) {
    return $fragment;
  }


  $fragment = preg_replace("/(\sstyle=['\"][^>]*?)(background-image:.*?url\((\s*.*?\s*)\));?(.*?['\"])/xis", '$1$4 imageus-css-bg imageus-src=$3 imageus', $fragment);
  $fragment = preg_replace("/(\sstyle=['\"][^>]*?background:.*?)(url\((\s*.*?\s*)\));?(.*?['\"])/xis", '$1$4 imageus-css-bg imageus-src=$3 imageus', $fragment);

  $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

	if (strpos($fragment, 'http:') === false && strpos($fragment, 'https:') === false) {
    $from = '/'.preg_quote("//", '/').'/';
		$fragment = preg_replace($from, $protocol, $fragment, 1);
	}

  return $fragment;
}

function imgus_process_image_fragment($img, $hosts) {
  preg_match('/\bsrc[\s\r\n]*=[\s\r\n]*[\'"]?(.*?)[\'">\s\r\n]/xis', $img, $matches);
  $src = $matches[1];

  $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
	
	$src = str_replace("https:", "", $src);
	$src = str_replace("http:", "", $src);
	$src = ltrim($src, "//");

  if (!preg_match("/$hosts/", $src)) {
    return $img;
  }

  $transparent_src  = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";
  $img = preg_replace('/<img(.*?)src=(["\']?).*?[\'">\s\r\n]/is', '<img$1src="' . $protocol . $transparent_src . '" imageus imageus-src="' . $protocol . $src . '"', $img);
  $img = preg_replace('/srcset=/is', 'imageus-srcset=', $img);
  $img = preg_replace('/sizes=/is', 'imageus-sizes=', $img);

  return $img;
}


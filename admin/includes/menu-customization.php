<?php

add_action('admin_menu', 'imgus_register_menu_page');
function imgus_register_menu_page() {
  add_menu_page(
    'Dashboard',
    'imageus',
    'manage_options',
    'imageus',
    'imageus_settings',
    'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACYklEQVQ4T5WSXWgNYBjHf897zs7ZmbE2nO1gjCjNR8u0j5KLnRtupFaUXHAl2VxIk8SFlV34SEhcUaTEDWFSJDdDuCIX5Gu2s2FjI+fM2Xn/OttJ67TIc/e+/d/f87zP/2/k1auFa8ORsoFiYLpLByswX4mjyrwWYDYfKBe6lgm59squrqQN1NdPG0m7OE7VDpsrMRtUAcwwVCKsCCgAbEKvr5itiT3pemyJ2saDoDYgnD/NX87exKaKZw8vW2JFwzWMdZOIR3N3wclB2h17+uioJVY2nkLakSfqM9iPmZfUDswCPPARiAKFwMnY04c7rbe2YZfBYcBNgNwYTA43V0ejvv978oqw9c70YFCupVTEzXRAcL+c9EbrXVnfbLKLOapykB4za8PLyzhioA9p21rXV7i6QPb25dzkt6nya1Lpgr3WV9tQL7iZtc3E9ZCzW7+k3YJ5QBY4GpBaot3FRc50DEhjnNpT4s8fCn56Y4mahioCdtdBsjMV3Lalv6DsTiw5XBPSvgzEg8bxJT2RO58z7pyhWG5CL7iuUd9q75etKg2HMhdS3p+r6ila7rA2L13ePkVnjkRTS3cNhl+cHQ4cd1CXt+iUoc32oro6VFU4ddmcj8WLh9BpYFpWKHgkU4eTbQA2TWKlB2sbT1c0vtyhq8Ci/C65FAYmz4KdHgO4mU2tGCf+I4lj0uwexgCB8vhGSZfysvAv3gjQMf6FiqY6J24jSie8ylqYBn4CQ8AXiYSZejDrNvQ8k/l1bxwwpzHi0pEDiHWCPpPe4twbw7/LeNeN6CfMAJHQD153Zjv/qd91u/BHftPCoAAAAABJRU5ErkJggg=='
  );
}

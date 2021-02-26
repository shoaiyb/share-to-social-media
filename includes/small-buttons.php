<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function get_small_buttons_markup_arr( $stsm_options ){
	$service_markup_arr = array(
								'facebook' => '<div class="s-single-share">
												<div class="fb-share-button" data-href="'.get_permalink().'" data-type="button"></div>
												</div>',
								'twitter' => '<div class="s-single-share">
												<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
												</div>',
								'googleplus' => '<div class="s-single-share">
												<div class="g-plusone" data-size="medium" data-annotation="none"></div>
												</div>',
								'digg' => '',
								'reddit' => '<div class="s-single-share">
												<a href="http://www.reddit.com/submit" onclick="window.location = \'http://www.reddit.com/submit?url=\' + encodeURIComponent(window.location); return false"> <img src="'.plugins_url( '../images/spreddit7.gif' , __FILE__ ).'"></a>
											</div>',
								'linkedin' => '<div class="s-single-share">
													<script type="IN/Share"></script>
												</div>',
								'stumbleupon' => '<div class="s-single-share">
												<su:badge layout="4"></su:badge>
												</div>',
								'tumblr' => '<div class="s-single-share">
												<a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD4AAAAUCAMAAADiKH4mAAAAXVBMVEU1RlsqKlU0RFs1RVz///83R142Rl3z9Pbk5+o3R11BUGZveopkcYLc3uJ9h5bGytGIkqA8TGL8/PxXZXj3+Pm7wcjX2t+xt8Dt7vBHVmqeprGVnanO0deQmaZPXXHFvKIkAAAABHRSTlORBpGJTtwcNgAAAetJREFUeF5dVNeWJSEI9M4Upo453PT/n7lAw8Ms9lG0LCn00OHxE4u0UmKkyMaO+CVS0TlDOjdAmk/DIwSKxU08xbQjmfhHAgnuGAnyG9g3gh1Bgt4iLLZTXIKN0oKC5JLUZyNXaWtRjGyNUVcbXPjUXIWU5zIsQqnNc5GF2j5bTyGaE1QTW4Pe9zvdLjMDjdDfwCijK9foFq3u6C0vpZL2in1mNAxQP2NUVEBLLZjGEzhzGfJYc851yPnTre/2SOeTYsJwpq3yKOiwrftVCikt2LW/Z+zv2OE1bUB9rkBOwJrBohJWhg9i+jQAkoxfYIh0K05oY2F6+QKVnYEa8NKOJ0N9eSHxOMYW+PYjMUVpIeoxorAtQo9Cjx2zFnEGHAw1sQEmo9d45y/M4O8gewqzZGNVx+kafcRZnF76z8QcsSCRoySPvC0b0rACr/bE/j2AT5uxLwnnkXD0M4ZLFhd9QWWFuxYoLh3m/rtj3jLSC0CTgE6cPs2bMAcAzERX89ra4wXtdXKJomuKqstzsn6q0UpAGk1WVUz3W9Ac7DCyIxgxlTp6ccpIJt7L1AN5hdG98f8ycYvFHs5c+XyjV5tH4UbamwJBSESH4CVmBMPkM02koCdOGsrsNzyCFR/9/SU5z4VaUEPv6c/jH8mZKoN2NK72AAAAAElFTkSuQmCC\') top left no-repeat transparent;">Share on Tumblr</a>
												</div>',
								'pinterest' => '<div class="s-single-share">
													<a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red"><img src="'.plugins_url( '../images/pinit_fg_en_rect_red_20.png' , __FILE__ ).'"></a>
													<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
												</div>',
								'email' => '<div class="s-single-share">
												<a href="mailto:?Subject='.str_replace(' ', '%20', get_the_title()).'&Body='.str_replace(' ', '%20', 'Here is the link to the article: '.get_permalink()).'" title="Email" class="stms-email"><img src="'.plugins_url( '../images/share-email.png' , __FILE__ ).'"></a>
											</div>'
							);
	return $service_markup_arr;
}
?>

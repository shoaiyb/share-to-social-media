<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function get_buttons_w_c_markup_arr( $stsm_options ){
	$service_markup_arr = array(
								'facebook' => '<a href="http://www.facebook.com/sharer.php?u='.get_permalink().'" target="_blank" title="Share to Facebook" class="stsm-facebook hint--top"></a>',
								'twitter' => '<a href="http://twitter.com/intent/tweet?text='.get_the_title().'&url='.get_permalink().'" target="_blank"  title="Share to Twitter" class="stsm-twitter hint--top"></a>',
								'googleplus' => '<a href="https://plus.google.com/share?url='.get_permalink().'" target="_blank"  title="Share to Google Plus" class="stsm-google-plus hint--top"></a>',
								'digg' => '<a href="http://www.digg.com/submit?url='.get_permalink().'" target="_blank"  title="Share to Digg" class="stsm-digg hint--top"></a>',
								'reddit' => '<a href="http://reddit.com/submit?url='.get_permalink().'&title='.get_the_title().'" target="_blank" title="Share to Reddit" class="stsm-reddit hint--top"></a>',
								'linkedin' => '<a href="http://www.linkedin.com/shareArticle?mini=true&url='.get_permalink().'" target="_blank" title="Share to LinkedIn" class="stsm-linkedin hint--top"></a>',
								'stumbleupon' => '<a href="http://www.stumbleupon.com/submit?url='.get_permalink().'&title='.get_the_title().'" target="_blank" title="Share to StumbleUpon" class="stsm-stumbleupon hint--top"></a>',
								'tumblr' => '<a href="http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&name='.urlencode(get_the_title()).'" target="_blank" title="Share to Tumblr" class="stsm-tumblr hint--top"></a>',
								'pinterest' => '<div class="pinit-btn-div"><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="red" title="Share to Pinterest" class="stsm-pinterest hint--top"></a></div>
								<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>',
								'email' => '<a href="mailto:?Subject='.str_replace(' ', '%20', get_the_title()).'&Body='.str_replace(' ', '%20', 'Here is the link to the article: '.get_permalink()).'" title="Email this article" class="stsm-email hint--top"></a>'
							);
	return $service_markup_arr;
}
?>

<?php

if(function_exists('add_action')) {

	add_action('wp_head', 'google_analytics');

}

function google_analytics() {

	?>

	<!-- Google Tracking deactivation for EU market -->
	<script data-mce-type="text/javascript">
        var gaProperty = 'UA-XXXXXXXXX-X';
        var disableStr = 'ga-disable-' + gaProperty;
        if (document.cookie.indexOf(disableStr + '=true') > -1) {
            window[disableStr] = true;
        }
        function gaOptout() {
            document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
            window[disableStr] = true;
            alert('Das Tracking durch Google Analytics wurde in Ihrem Browser für diese Website deaktiviert.');
        }
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-71419523-7"></script>
	<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-XXXXXXXX-X', { 'anonymize_ip': true });
	</script>


	<?php

}
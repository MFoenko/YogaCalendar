function createIframe(url){
	var iframe = document.createElement("IFRAME");
	iframe.src = url;
	document.body.appendChild(iframe);
	var closeButton = document.createElement("IMG");
	closeButton.src = "images/big_cross.png";
	closeButton.setAttribute("onclick","this.parentNode.parentNode.removeChild(this.parentNode);");
	iframe.appendChild(closeButton);
}

$(document).ready(function() {
    $("#RCGLink").fancybox({
    	'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
    });
    $("#SettingsLink").fancybox({
    	'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
    });
});
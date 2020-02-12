// import LazyLoad from "vanilla-lazyload";

addEventListener('DOMContentLoaded', function() {

	console.log('D00M is ready');

	function logElementEvent(eventName, element) {
		console.log(
			Date.now(),
			eventName,
			element.getAttribute("data-src")
		);
	}

	const callback_enter = function(element) {
		logElementEvent("🔑 ENTERED", element);
	};
	const callback_exit = function(element) {
		logElementEvent("🚪 EXITED", element);
	};
	const callback_reveal = function(element) {
		logElementEvent("👁️ REVEALED", element);
	};
	const callback_loaded = function(element) {
		logElementEvent("👍 LOADED", element);
	};
	const callback_error = function(element) {
		logElementEvent("💀 ERROR", element);
		element.src =
			"https://via.placeholder.com/440x560/?text=Error+Placeholder";
	};
	const callback_finish = function() {
		logElementEvent("✔️ FINISHED", document.documentElement);
	};

	const lazyLoadInstance = new LazyLoad({

		elements_selector: ".lazyload",
		use_native: true,
		load_delay: 200,
		callback_enter: callback_enter,
		callback_exit: callback_exit,
		callback_reveal: callback_reveal,
		callback_loaded: callback_loaded,
		callback_error: callback_error,
		callback_finish: callback_finish
		// ... more custom settings?
	});
});

! function(J) {
	function H() {
		var d = E.getBoundingClientRect().width;
		var e = (d / 7.5 > 100 * B ? 100 * B : (d / 7.5 < 42 ? 42 : d / 7.5));
		E.style.fontSize = e + "px", J.rem = e
	}
	var G, F = J.document,
		E = F.documentElement,
		D = F.querySelector('meta[name="viewport"]'),
		B = 0,
		A = 0;
	if(D) {
		var y = D.getAttribute("content").match(/initial\-scale=([\d\.]+)/);
		y && (A = parseFloat(y[1]), B = parseInt(1 / A))
	}
	if(!B && !A) {
		var u = (J.navigator.appVersion.match(/android/gi), J.navigator.appVersion.match(/iphone/gi)),
			t = J.devicePixelRatio;
		B = u ? t >= 3 && (!B || B >= 3) ? 3 : t >= 2 && (!B || B >= 2) ? 2 : 1 : 1, A = 1 / B
	}
	if(E.setAttribute("data-dpr", B), !D) {
		if(D = F.createElement("meta"), D.setAttribute("name", "viewport"), D.setAttribute("content", "initial-scale=" + A + ", maximum-scale=" + A + ", minimum-scale=" + A + ", user-scalable=no"), E.firstElementChild) {
			E.firstElementChild.appendChild(D)
		} else {
			var s = F.createElement("div");
			s.appendChild(D), F.write(s.innerHTML)
		}
	}
	J.addEventListener("resize", function() {
		clearTimeout(G), G = setTimeout(H, 300)
	}, !1), J.addEventListener("pageshow", function(b) {
		b.persisted && (clearTimeout(G), G = setTimeout(H, 300))
	}, !1), H()
}(window);
if(typeof(M) == 'undefined' || !M) {
	window.M = {};
}
!function (i) { var o = i(window), n = i(document), t = i("body"), a = i("#wrapper"), e = i("#footer"), s = a.children(".panel"), r = i(".actions.animated a"), l = null; breakpoints({ xlarge: ["1281px", "1680px"], large: ["981px", "1280px"], medium: ["737px", "980px"], small: ["481px", "736px"], xsmall: ["361px", "480px"], xxsmall: [null, "360px"] }), o.on("load", function () { window.setTimeout(function () { t.removeClass("is-preload-0"), window.setTimeout(function () { t.removeClass("is-preload-1") }, 1500) }, 100) }), r.on("click", function (o) { var n = i(this).attr("href"); "#" != n.charAt(0) || n.length > 1 && 0 == s.filter(n).length || (o.preventDefault(), o.stopPropagation(), window.location.hash = "", window.location.hash = n, l = i(this)) }); var c, d = !0; s.each(function () { var o = i(this).children(".image"), n = o.find("img"), t = n.data("position"); o.css("background-image", "url(" + n.attr("src") + ")"), t && o.css("background-position", t), n.hide() }), window.setTimeout(function () { d = !1 }, 1250), o.on("hashchange", function (t) { var a, r = 0; a = window.location.hash && "#" != window.location.hash ? i(window.location.hash) : s.first(), t.preventDefault(), t.stopPropagation(), d || (d = !0, l && (l.parents("ul"), l.addClass("active"), r = 250), window.setTimeout(function () { s.addClass("inactive"), e.addClass("inactive"), window.setTimeout(function () { s.hide(), a.show(), n.scrollTop(0), window.setTimeout(function () { a.removeClass("inactive"), l && (l.removeClass("active"), l = null), d = !1, o.triggerHandler("--refresh"), window.setTimeout(function () { e.removeClass("inactive") }, 250) }, 100) }, 350) }, r)) }), c = window.location.hash && "#" != window.location.hash ? i(window.location.hash) : s.first(), s.not(c).addClass("inactive").hide(), "ie" == browser.name && (o.on("--refresh", function () { a.css("height", "auto"), window.setTimeout(function () { a.height() < o.height() && a.css("height", "100vh") }, 0) }), o.on("load", function () { o.triggerHandler("--refresh") }), i(".actions.animated").removeClass("animated")) }(jQuery);
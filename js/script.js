! function(a) {
	"use strict";
	a.fn.bjqs = function(b) {
		var c = {
			width: 700,
			height: 300,
			animtype: "fade",
			animduration: 450,
			animspeed: 4e3,
			automatic: !0,
			showcontrols: !0,
			centercontrols: !0,
			nexttext: "Next",
			prevtext: "Prev",
			showmarkers: !0,
			centermarkers: !0,
			keyboardnav: !0,
			hoverpause: !0,
			usecaptions: !0,
			randomstart: !1,
			responsive: !1
		}, d = a.extend({}, c, b),
			e = this,
			f = e.find("ul.bjqs"),
			g = f.children("li"),
			h = null,
			i = null,
			j = null,
			k = null,
			l = null,
			m = null,
			n = null,
			o = null,
			p = {
				slidecount: g.length,
				animating: !1,
				paused: !1,
				currentslide: 1,
				nextslide: 0,
				currentindex: 0,
				nextindex: 0,
				interval: null
			}, q = {
				width: null,
				height: null,
				ratio: null
			}, r = {
				fwd: "forward",
				prev: "previous"
			}, s = function() {
				g.addClass("bjqs-slide"), d.responsive ? t() : v(), p.slidecount > 1 && (d.randomstart && C(), d.showcontrols && x(), d.showmarkers && y(), d.keyboardnav && z(), d.hoverpause && d.automatic && A(), "slide" === d.animtype && w()), d.usecaptions && B(), "slide" !== d.animtype || d.randomstart || (p.currentindex = 1, p.currentslide = 2), f.show(), g.eq(p.currentindex).show(), d.automatic && (p.interval = setInterval(function() {
					E(r.fwd, !1)
				}, d.animspeed))
			}, t = function() {
				q.width = e.outerWidth(), q.ratio = q.width / d.width, q.height = d.height * q.ratio, "fade" === d.animtype && (g.css({
					height: d.height,
					width: "100%"
				}), g.children("img").css({
					height: d.height,
					width: "100%"
				}), f.css({
					height: d.height,
					width: "100%"
				}), e.css({
					height: d.height,
					"max-width": d.width,
					position: "relative"
				}), q.width < d.width && (g.css({
					height: q.height
				}), g.children("img").css({
					height: q.height
				}), f.css({
					height: q.height
				}), e.css({
					height: q.height
				})), a(window).resize(function() {
					q.width = e.outerWidth(), q.ratio = q.width / d.width, q.height = d.height * q.ratio, g.css({
						height: q.height
					}), g.children("img").css({
						height: q.height
					}), f.css({
						height: q.height
					}), e.css({
						height: q.height
					})
				})), "slide" === d.animtype && (g.css({
					height: d.height,
					width: d.width
				}), g.children("img").css({
					height: d.height,
					width: d.width
				}), f.css({
					height: d.height,
					width: d.width * d.slidecount
				}), e.css({
					height: d.height,
					"max-width": d.width,
					position: "relative"
				}), q.width < d.width && (g.css({
					height: q.height
				}), g.children("img").css({
					height: q.height
				}), f.css({
					height: q.height
				}), e.css({
					height: q.height
				})), a(window).resize(function() {
					q.width = e.outerWidth(), q.ratio = q.width / d.width, q.height = d.height * q.ratio, g.css({
						height: q.height,
						width: q.width
					}), g.children("img").css({
						height: q.height,
						width: q.width
					}), f.css({
						height: q.height,
						width: q.width * d.slidecount
					}), e.css({
						height: q.height
					}), m.css({
						height: q.height,
						width: q.width
					}), u(function() {
						E(!1, p.currentslide)
					}, 200, "some unique string")
				}))
			}, u = function() {
				var a = {};
				return function(b, c, d) {
					d || (d = "Don't call this twice without a uniqueId"), a[d] && clearTimeout(a[d]), a[d] = setTimeout(b, c)
				}
			}(),
			v = function() {
				g.css({
					height: d.height,
					width: d.width
				}), f.css({
					height: d.height,
					width: d.width
				}), e.css({
					height: d.height,
					width: d.width,
					position: "relative"
				})
			}, w = function() {
				n = g.eq(0).clone(), o = g.eq(p.slidecount - 1).clone(), n.attr({
					"data-clone": "last",
					"data-slide": 0
				}).appendTo(f).show(), o.attr({
					"data-clone": "first",
					"data-slide": 0
				}).prependTo(f).show(), g = f.children("li"), p.slidecount = g.length, m = a('<div class="bjqs-wrapper"></div>'), d.responsive && q.width < d.width ? (m.css({
					width: q.width,
					height: q.height,
					overflow: "hidden",
					position: "relative"
				}), f.css({
					width: q.width * (p.slidecount + 2),
					left: -q.width * p.currentslide
				})) : (m.css({
					width: d.width,
					height: d.height,
					overflow: "hidden",
					position: "relative"
				}), f.css({
					width: d.width * (p.slidecount + 2),
					left: -d.width * p.currentslide
				})), g.css({
					"float": "left",
					position: "relative",
					display: "list-item"
				}), m.prependTo(e), f.appendTo(m)
			}, x = function() {
				if (h = a('<ul class="bjqs-controls"></ul>'), i = a('<li class="bjqs-next"><a href="#" data-direction="' + r.fwd + '">' + d.nexttext + "</a></li>"), j = a('<li class="bjqs-prev"><a href="#" data-direction="' + r.prev + '">' + d.prevtext + "</a></li>"), h.on("click", "a", function(b) {
					b.preventDefault();
					var c = a(this).attr("data-direction");
					p.animating || (c === r.fwd && E(r.fwd, !1), c === r.prev && E(r.prev, !1))
				}), j.appendTo(h), i.appendTo(h), h.appendTo(e), d.centercontrols) {
					h.addClass("v-centered");
					var b = (e.height() - i.children("a").outerHeight()) / 2,
						c = 100 * (b / d.height),
						f = c + "%";
					i.find("a").css("top", f), j.find("a").css("top", f)
				}
			}, y = function() {
				if (k = a('<ol class="bjqs-markers"></ol>'), a.each(g, function(b) {
					var e = b + 1,
						f = b + 1;
					"slide" === d.animtype && (f = b + 2);
					var g = a('<li><a href="#">' + e + "</a></li>");
					e === p.currentslide && g.addClass("active-marker"), g.on("click", "a", function(a) {
						a.preventDefault(), !p.animating && p.currentslide !== f && E(!1, f)
					}), g.appendTo(k)
				}), k.appendTo(e), l = k.find("li"), d.centermarkers) {
					k.addClass("h-centered");
					var b = (d.width - k.width()) / 2;
					k.css("left", b)
				}
			}, z = function() {
				a(document).keyup(function(a) {
					p.paused || (clearInterval(p.interval), p.paused = !0), p.animating || (39 === a.keyCode ? (a.preventDefault(), E(r.fwd, !1)) : 37 === a.keyCode && (a.preventDefault(), E(r.prev, !1))), p.paused && d.automatic && (p.interval = setInterval(function() {
						E(r.fwd)
					}, d.animspeed), p.paused = !1)
				})
			}, A = function() {
				e.hover(function() {
					p.paused || (clearInterval(p.interval), p.paused = !0)
				}, function() {
					p.paused && (p.interval = setInterval(function() {
						E(r.fwd, !1)
					}, d.animspeed), p.paused = !1)
				})
			}, B = function() {
				a.each(g, function(b, c) {
					var d = a(c).children("img:first-child").attr("title");
					d || (d = a(c).children("a").find("img:first-child").attr("title")), d && (d = a('<p class="bjqs-caption">' + d + "</p>"), d.appendTo(a(c)))
				})
			}, C = function() {
				var a = Math.floor(Math.random() * p.slidecount) + 1;
				p.currentslide = a, p.currentindex = a - 1
			}, D = function(a) {
				a === r.fwd ? g.eq(p.currentindex).next().length ? (p.nextindex = p.currentindex + 1, p.nextslide = p.currentslide + 1) : (p.nextindex = 0, p.nextslide = 1) : g.eq(p.currentindex).prev().length ? (p.nextindex = p.currentindex - 1, p.nextslide = p.currentslide - 1) : (p.nextindex = p.slidecount - 1, p.nextslide = p.slidecount)
			}, E = function(a, b) {
				if (!p.animating && (p.animating = !0, b ? (p.nextslide = b, p.nextindex = b - 1) : D(a), "fade" === d.animtype && (d.showmarkers && (l.removeClass("active-marker"), l.eq(p.nextindex).addClass("active-marker")), g.eq(p.currentindex).fadeOut(d.animduration), g.eq(p.nextindex).fadeIn(d.animduration, function() {
					p.animating = !1, p.currentslide = p.nextslide, p.currentindex = p.nextindex
				})), "slide" === d.animtype)) {
					if (d.showmarkers) {
						var c = p.nextindex - 1;
						c === p.slidecount - 2 ? c = 0 : -1 === c && (c = p.slidecount - 3), l.removeClass("active-marker"), l.eq(c).addClass("active-marker")
					}
					p.slidewidth = d.responsive && q.width < d.width ? q.width : d.width, f.animate({
						left: -p.nextindex * p.slidewidth
					}, d.animduration, function() {
						p.currentslide = p.nextslide, p.currentindex = p.nextindex, "last" === g.eq(p.currentindex).attr("data-clone") ? (f.css({
							left: -p.slidewidth
						}), p.currentslide = 2, p.currentindex = 1) : "first" === g.eq(p.currentindex).attr("data-clone") && (f.css({
							left: -p.slidewidth * (p.slidecount - 2)
						}), p.currentslide = p.slidecount - 1, p.currentindex = p.slidecount - 2), p.animating = !1
					})
				}
			};
		s()
	}
}(jQuery),
function(a) {
	var b = null;
	a.modal = function(c, d) {
		a.modal.close();
		var e, f;
		if (this.$body = a("body"), this.options = a.extend({}, a.modal.defaults, d), this.options.doFade = !isNaN(parseInt(this.options.fadeDuration, 10)), c.is("a"))
			if (f = c.attr("href"), /^#/.test(f)) {
				if (this.$elm = a(f), 1 !== this.$elm.length) return null;
				this.open()
			} else this.$elm = a("<div>"), this.$body.append(this.$elm), e = function(a, b) {
				b.elm.remove()
			}, this.showSpinner(), c.trigger(a.modal.AJAX_SEND), a.get(f).done(function(d) {
				b && (c.trigger(a.modal.AJAX_SUCCESS), b.$elm.empty().append(d).on(a.modal.CLOSE, e), b.hideSpinner(), b.open(), c.trigger(a.modal.AJAX_COMPLETE))
			}).fail(function() {
				c.trigger(a.modal.AJAX_FAIL), b.hideSpinner(), c.trigger(a.modal.AJAX_COMPLETE)
			});
			else this.$elm = c, this.open()
	}, a.modal.prototype = {
		constructor: a.modal,
		open: function() {
			var b = this;
			this.options.doFade ? (this.block(), setTimeout(function() {
				b.show()
			}, this.options.fadeDuration * this.options.fadeDelay)) : (this.block(), this.show()), this.options.escapeClose && a(document).on("keydown.modal", function(b) {
				27 == b.which && a.modal.close()
			}), this.options.clickClose && this.blocker.click(a.modal.close)
		},
		close: function() {
			this.unblock(), this.hide(), a(document).off("keydown.modal")
		},
		block: function() {
			var b = this.options.doFade ? 0 : this.options.opacity;
			this.$elm.trigger(a.modal.BEFORE_BLOCK, [this._ctx()]), this.blocker = a('<div class="jquery-modal blocker"></div>').css({
				top: 0,
				right: 0,
				bottom: 0,
				left: 0,
				width: "100%",
				height: "100%",
				position: "fixed",
				zIndex: this.options.zIndex,
				background: this.options.overlay,
				opacity: b
			}), this.$body.append(this.blocker), this.options.doFade && this.blocker.animate({
				opacity: this.options.opacity
			}, this.options.fadeDuration), this.$elm.trigger(a.modal.BLOCK, [this._ctx()])
		},
		unblock: function() {
			this.options.doFade ? this.blocker.fadeOut(this.options.fadeDuration, function() {
				this.remove()
			}) : this.blocker.remove()
		},
		show: function() {
			this.$elm.trigger(a.modal.BEFORE_OPEN, [this._ctx()]), this.options.showClose && (this.closeButton = a('<a href="#close-modal" rel="modal:close" class="close-modal">' + this.options.closeText + "</a>"), this.$elm.append(this.closeButton)), this.$elm.addClass(this.options.modalClass + " current"), this.center(), this.options.doFade ? this.$elm.fadeIn(this.options.fadeDuration) : this.$elm.show(), this.$elm.trigger(a.modal.OPEN, [this._ctx()])
		},
		hide: function() {
			this.$elm.trigger(a.modal.BEFORE_CLOSE, [this._ctx()]), this.closeButton && this.closeButton.remove(), this.$elm.removeClass("current"), this.options.doFade ? this.$elm.fadeOut(this.options.fadeDuration) : this.$elm.hide(), this.$elm.trigger(a.modal.CLOSE, [this._ctx()])
		},
		showSpinner: function() {
			this.options.showSpinner && (this.spinner = this.spinner || a('<div class="' + this.options.modalClass + '-spinner"></div>').append(this.options.spinnerHtml), this.$body.append(this.spinner), this.spinner.show())
		},
		hideSpinner: function() {
			this.spinner && this.spinner.remove()
		},
		center: function() {
			this.$elm.css({
				position: "fixed",
				top: "50%",
				left: "50%",
				marginTop: -(this.$elm.outerHeight() / 2),
				marginLeft: -(this.$elm.outerWidth() / 2),
				zIndex: this.options.zIndex + 1
			})
		},
		_ctx: function() {
			return {
				elm: this.$elm,
				blocker: this.blocker,
				options: this.options
			}
		}
	}, a.modal.prototype.resize = a.modal.prototype.center, a.modal.close = function(a) {
		return b ? (a && a.preventDefault(), b.close(), a = b.$elm, b = null, a) : void 0
	}, a.modal.resize = function() {
		b && b.resize()
	}, a.modal.defaults = {
		overlay: "#000",
		opacity: .75,
		zIndex: 1,
		escapeClose: !0,
		clickClose: !0,
		closeText: "Close",
		modalClass: "modal",
		spinnerHtml: null,
		showSpinner: !0,
		showClose: !0,
		fadeDuration: null,
		fadeDelay: 1
	}, a.modal.BEFORE_BLOCK = "modal:before-block", a.modal.BLOCK = "modal:block", a.modal.BEFORE_OPEN = "modal:before-open", a.modal.OPEN = "modal:open", a.modal.BEFORE_CLOSE = "modal:before-close", a.modal.CLOSE = "modal:close", a.modal.AJAX_SEND = "modal:ajax:send", a.modal.AJAX_SUCCESS = "modal:ajax:success", a.modal.AJAX_FAIL = "modal:ajax:fail", a.modal.AJAX_COMPLETE = "modal:ajax:complete", a.fn.modal = function(c) {
		return 1 === this.length && (b = new a.modal(this, c)), this
	}, a(document).on("click.modal", 'a[rel="modal:close"]', a.modal.close), a(document).on("click.modal", 'a[rel="modal:open"]', function(b) {
		b.preventDefault(), a(this).modal()
	})
}(jQuery),
function(a) {
	a.fn.cookieBar = function(b) {
		var c = a.extend({
			closeButton: "none",
			secure: !1,
			path: "/",
			domain: ""
		}, b);
		return this.each(function() {
			var d = a(this);
			d.hide(), "none" == c.closeButton && (d.append('<a class="cookiebar-close">Continue</a>'), c = a.extend({
				closeButton: ".cookiebar-close"
			}, b)), "hide" != a.cookie("cookiebar") && d.show(), d.find(c.closeButton).click(function() {
				return d.hide(), a.cookie("cookiebar", "hide", {
					path: c.path,
					secure: c.secure,
					domain: c.domain,
					expires: 30
				}), !1
			})
		})
	}, a.cookieBar = function(b) {
		a("body").prepend('<div class="ui-widget"><div class="cookie-message ui-widget-header blue"><p class="cookie-msg-inner">By using this website you allow us to place cookies on your computer. They are harmless and never personally identify you.</p></div></div>'), a(".cookie-message").cookieBar(b)
	}
}(jQuery),
function(a) {
	a.cookie = function(b, c, d) {
		if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(c)) || null === c || void 0 === c)) {
			if (d = a.extend({}, d), (null === c || void 0 === c) && (d.expires = -1), "number" == typeof d.expires) {
				var e = d.expires,
					f = d.expires = new Date;
				f.setDate(f.getDate() + e)
			}
			return c = String(c), document.cookie = [encodeURIComponent(b), "=", d.raw ? c : encodeURIComponent(c), d.expires ? "; expires=" + d.expires.toUTCString() : "", d.path ? "; path=" + d.path : "", d.domain ? "; domain=" + d.domain : "", d.secure ? "; secure" : ""].join("")
		}
		d = c || {};
		for (var j, g = d.raw ? function(a) {
				return a
			} : decodeURIComponent, h = document.cookie.split("; "), i = 0; j = h[i] && h[i].split("="); i++)
			if (g(j[0]) === b) return g(j[1] || "");
		return null
	}
}(jQuery), $().ready(function(a) {
	a("#slider").bjqs({
		height: 380,
		width: 980,
		animtype: "slide",
		nexttext: "&gt;",
		prevtext: "&lt;",
		responsive: !1,
		showmarkers: !1,
		usecaptions: !1,
		keyboardnav: !1
	}), a.modal.defaults = {
		overlay: "#000",
		opacity: .75,
		zIndex: 300,
		escapeClose: !0,
		clickClose: !0,
		closeText: "Zamknij",
		showClose: !0,
		modalClass: "modal",
		spinnerHtml: null,
		showSpinner: !0,
		fadeDuration: 200,
		fadeDelay: 0
	};
	var b = 0,
		c = a(".shop-item");
	c.each(function() {
		var c = a(this).height();
		b = Math.max(b, c)
	}).height(b).addClass("closed"), c.on("click", function() {
		c.addClass("closed"), a(this).removeClass("closed")
	}), a(".masterTooltip").hover(function() {
		var b = a(this).attr("title");
		a(this).data("tipText", b).removeAttr("title"), a('<p class="tooltip"></p>').text(b).appendTo("body").fadeIn(350)
	}, function() {
		a(this).attr("title", a(this).data("tipText")), a(".tooltip").remove()
	}).mousemove(function(b) {
		var c = b.pageX -5,
			d = b.pageY -5;
		a(".tooltip").css({
			top: d,
			left: c
		})
	}), a.cookieBar()
});
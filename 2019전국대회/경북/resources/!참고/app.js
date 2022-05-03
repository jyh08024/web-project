const dd = console.log;

const App = {
	init() {
		this.color = 'gray';
		this.line = 3;
		this.font = 16;

		this.hook();
		Clip.init();
		ani();
	},

	hook() {
		$(document)
			.on('mousedown mousemove mouseleave click', 'svg', this._event.bind(this))
			.on('mouseup', this, this._event.bind(this))
			.on('click', '.option-list > div', this._clickOption)
			.on('click', '.video-list img', Video.setItem)
			.on('click', '.video__tool .btn', this._clickTool)
	},

	_clickOption() {
		let val = $(this).data('val');
		let type = $(this).data('type');

		App[type] = val;

		$('.option-list > div').each((i, v) => {
			$(v).attr('data-color', App.color);
		})

		$(this).parent().find('*').removeClass('active');
		$(this).addClass('active');

		save();
	},

	_clickTool(e) {
		if ($(this).data('type') == 'edit') {
			edit();
			return;
		}

		if (!Video.item) {
			return alert('영화 홍보영상을 선택해주세요.');
		}
		
		if ($(this).hasClass('tool')) {
			$('.tool').removeClass('active');
			$(this).addClass('active');
			App.tool = $(this).data('type')
		} else
			eval($(this).data("type"))();

		save();
	},

	_event(e) {
		let type = e.type;
		let [x, y] = [e.offsetX, e.offsetY];

		if (type == 'mousedown') {
			this.stacks = [[x, y]];
		}

		if (type == 'mouseup') {
			this.stacks = false;
		}

		if (this.tool == 'Pen' || this.tool == 'Square') {
			if (type == 'mousemove' && this.stacks) {
				eval(this.tool).draw();
				this.stacks.push([x, y]);
			}

			if (type == 'mouseup') {
				eval(this.tool).end();
			}
		}

		if (this.tool == 'Text') {
			if (type == 'click') {
				Text.make(x, y);
			}
		}

		if (this.tool == 'Select') {
			if (type == 'mousedown' && $(e.target).attr('data-item') == 'item') {
				Select._click($(e.target), x, y);
				this.stacks = [x, y];
			}

			if (type == 'mousemove') {
				Select.move(x, y);
			}

			if (type == 'mouseup') {
				this.stacks = false;
				Select._end();
			}
		}
	}
}

// 자유 곡선
const Pen = {
	draw() {
		if (App.stacks.length == 2) {
			this.id = getId();
			Clip.make(this.id);
			this.$item = svg(this.id, 'polyline');
		}

		if (App.stacks.length >= 2) {
			this.$item.attr('points', App.stacks.reduce((a, b) => `${a} ${b.join(',')}`, '').substring(1));
		}
	},

	end() {
		this.$item = false;
	}
}

// 사각형
const Square = {
	draw() {
		if (App.stacks.length == 2) {
			this.id = getId();
			Clip.make(this.id);
			this.$item = svg(this.id);
		}

		if (App.stacks.length >= 2) {
			let s = App.stacks[0];
			let e = App.stacks[App.stacks.length - 1];

			this.$item.css({
				x: Math.min(s[0], e[0]),
				y: Math.min(s[1], e[1]),
				width: Math.abs(s[0] - e[0]),
				height: Math.abs(s[1] - e[1]),
			});
		}
	},

	end() {
		if (this.$item) {
			this.$item.css('background', App.color);
		}

		this.$item = false;
	}
}

// 비디오
const Video = {
	status: 'pause',
	item: false,

	setItem() {
		if ($(this).hasClass('active')) return;

		let src = $(this).attr('src').replace('-cover.jpg', '.mp4');
		$('video').attr('src', src);
		$(this).parent().parent().find('.active').removeClass('active');
		$(this).addClass('active');

		$('video')[0].onloadedmetadata = function() {
			$('svg *').remove();
			$('.time-line').html('');
			$('.line, .arc').css('left', '0px');
			Video.item = $(this);
			Video.dur = this.duration;
			$('.video-time, .handle').removeClass('hide');
			$('.handle .arc').draggable({
				containmen: '.handle',
				drag(e, ui) {
					let left = ui.position.left;
					Video.cur = 'pause';
					Video.item[0].currentTime = w2s(left);
					$('.line').css('left', left);
				}
			})
		}
	},

	set cur(type) {
		this.status = type;
		$('video')[0][type]();
	}
}

const Text = {
	make(x, y) {
		this.id = getId();
		this.$item = svg(this.id).append('<div contenteditable=""></div>');
		this.$item.css({
			width: App.font + 6,
			height: App.font + 16,
			border: '3px solid transparent',
			x, y
		});
		this.$item.find('div').css({
			minWidth: App.font,
			minHeight: App.font,
			fontSize: App.font,
			display: 'inline-block'
		})[0].focus();


		this.$item.find('div')
			.on('input', function() {
				let html = $(this).html();
				let $tmp = $(`<div>${html}</div>`).css({
					fontSize: App.font,
					display: 'inline-block',
				}).appendTo('body');

				$(this).parent().css({
					width: $tmp.width() + 7,
					height: $tmp.height() + 12,
				});

				$tmp.remove();
			})
			.on('focusout', function() {
				let html = $(this).html().trim();

				if (html) {
					Clip.make(Text.id);
					$(this).attr('contenteditable', false).css({
						'pointer-events': 'none',
					})
				} else {
					$(this).parent().remove();
				}
			})
	}
}

const Clip = {
	init() {
		$(document)
			.on('mousedown', '.time-line .clip', function(e) {
				Clip.id = $(this).attr('data-id');
				Clip.prev = [e.offsetX, e.offsetY];
				Select.active(Clip.id);
				setTime(Clip.id);
			})
			.on('mouseup', this, function() {
				Clip.id = false;
			})
	},

	make(id) {
		let $box = $(`
			<div class="clip-box" data-id='${id}'>
				<div class="me">
					<input type="checkbox" name="merge" class="merge" data-id='${id}'>
				</div>
				<div></div>
				<div class="clip" data-id='${id}'></div>
				<div class="clip-time">
					<div class="flex ac">
						클립 재생 시작 시간
						<div class="clip__start" style="margin-left: 10px;">00:00:00:00</div>
					</div>
					<div class="flex ac">
						클립 재생 시간
						<div class="clip__end" style="margin-left: 10px;">${s2t(Video.dur)}</div>
					</div>
				</div>
			</div>
		`).prependTo('.time-line');

		$('.time-line').sortable({
			update() {
				let arr = [];

				$('.time-line .clip-box').each((i, v) => {
					arr.push($(v).attr('data-id'));
				})

				$.each(arr, (i, v) => {
					$item = $(`svg *[data-id=${v}]`);
					let $clone = $item.clone();
					$('svg').prepend($clone);
					$item.remove();
				})
			}
		});

		$box.find('.clip').resizable({
			containment: $box,
			handles: 'e, w',
			resize(e, ui) {
				setTime($(this).attr('data-id'));

				$(this).draggable({
					containment: $box,
					drag(e, ui) {
						setTime($(this).attr('data-id'));
					}
				})
			}
		})

	},
}

const Select = {
	_click($item, x, y) {
		let id = $item.attr('data-id');
		this.id = id;
		this.active(id);
		this.prev = [x, y];
	},

	_end() {
		this.id = false;
	},

	active(id) {
		$('svg > *').each((i, v) => {
			if ($(v).attr('data-type') == 'outline') {
				$(v).remove();
			}

			$(v).css('border', '3px solid transparent');
		})

		$(`.clip`).removeClass('active');
		$(`.clip[data-id='${id}']`).addClass('active');

		let $item = $(`svg *[data-id='${id}']`);

		$item.each((i, v) => {
			if ($(v)[0].tagName == 'polyline') {
				let $clone = $item.clone().attr('data-type' , 'outline').css({
					strokeWidth: $item.css('stroke-width').replace('px', '') * 1 + 6,
					stroke: 'skyblue'
				})

				$(v).before($clone);
			} else {
				$(v).css('border', '3px solid skyblue');
			}
		})
	},

	move(x, y) {
		let $item = $(`svg *[data-id='${this.id}']`);

		if (!$item.length) return;

		let mx = x - this.prev[0];
		let my = y - this.prev[1];

		$item.each((i, v) => {
			$item = $(v);
			if ($item[0].tagName == 'polyline') {
				$item.each((i, v) => {
					let points = $(v).attr('points').split(' ').reduce((a, b) => {
						let tmp = b.split(',');
						tmp = [
							tmp[0] * 1 + mx,
							tmp[1] * 1 + my,
						].join(',');
						return `${a} ${tmp}`;
					}, '').substring(1);

					$(v).attr('points', points);
				})
			} else {
				$item.each((i, v) => {
					$(v).css({
						x: $(v).css('x').replace('px', '') * 1 + mx,
						y: $(v).css('y').replace('px', '') * 1 + my,
					})	
				})
			}
		})

		this.prev = [x, y]
	}
}

// 비디오 재생
function play() {
	Video.cur = 'play';
}

// 비디오 정지
function pause() {
	Video.cur = 'pause';
}

// 선택삭제
function remove() {
	let id = $('.clip.active').data('id');

	$('svg *').each((i, v) => {
		if ($(v).attr('data-id') == id) {
			$(v).remove();
		}
	})
}

// 초기화
function removeAll() {
	$('svg *').remove();
	$('.time-line').html('');
	$('video').attr('src', '')
	$('.line, .arc').css('left', '0px');
	$('.video-time, .handle').addClass('hide');
	$('.active').removeClass('active');
	$('.option-list > div:nth-child(1)').addClass('active');

	Video.item = false;
}

// svg 아이템 생성
function svg(id, type = 'foreignObject') {
	return $(document.createElementNS('http://www.w3.org/2000/svg', type)).css({
		color: App.color,
		fontSize: App.font,
		fill: 'none',
		strokeLinejoin: 'round',
		strokeLinecap: 'round',
		stroke: App.color,
		strokeWidth: App.line,
		border: `3px solid ${App.color}`
	}).attr({
		'data-id': id,
		'data-active': '',
		'data-type': type == 'polyline' ?  'line' : 'foreignObject',
		'data-active': '',
		'data-start': 0,
		'data-end': Video.dur,
		'data-item': 'item'
	}).appendTo('svg');
}

function merge() {
	let starts = [];
	let ends = [];
	let newid = getId();

	$('.time-line input').each((i, v) => {
		if (!$(v).prop('checked')) return true;

		let id = $(v).attr('data-id');
		let $item = $(`svg *[data-id='${id}']`).attr('data-id', newid);

		$(v).closest('.clip-box').remove();

		starts.push($item.attr('data-start')*1);
		ends.push($item.attr('data-end')*1);
	})

	$('svg > *').each((i, v) => {
		if ($(v).attr('data-type') == 'outline') {
			$(v).remove();
		}

		$(v).css('border', '3px solid transparent');
	});

	let start = Math.min(...starts);
	let end = Math.max(...ends);

	$(`svg *[data-id='${newid}']`).each((i, v) => {
		$(v).attr({
			'data-start': start,
			'data-end': end,
		})
	})

	Clip.make(newid);

	let left = start / Video.dur * 1100;
	let w = (end - start) / Video.dur * 1100;

	let $clip = $(`.clip-box[data-id='${newid}'] .clip`).css({
		left: left,
		width: w,
	});

	$clip.find('.clip__start').html(s2t(left));
	$clip.find('.clip__end').html(s2t(w));
}



// width -> 초
function w2s(w) {
	return w / 1100 * Video.dur;
}

// 초 -> 00:00:00:00 형식 변환
function s2t(s) {
	let h = pad(Math.floor(s / 3600));
	let m = pad(Math.floor(s / 60));
	let ss = pad(Math.floor(s % 60));
	let ms = pad(Math.floor(Math.floor(s % 1 * 10000) / 100));

	return `${h}:${m}:${ss}:${ms}`;
}

function setTime(id) {
	let $clip = $(`.clip[data-id='${id}']`);
	let s = $clip.css('left').replace('px', '') * 1;
	let e = $clip.width();
	s = w2s(s)
	e = w2s(e)

	$clip.parent().find('.clip__start').html(s2t(s));
	$clip.parent().find('.clip__end').html(s2t(e));

	$(`svg > *[data-id='${id}']`).each((i, v) => {
		$(v).attr({
			'data-start': s,
			'data-end': e,
		})
	})
}

function getId() {
	return (new Date()).getTime();
}

function ani() {
	requestAnimationFrame(ani);

	if (!Video.item) return;

	let now = $('video')[0].currentTime;

	let left = now / Video.dur * 1100;
	$('.arc, .line').css('left', left)

	$('.video__now').html(s2t(now));
	$('.video__end').html(s2t(Video.dur));

	$('svg > *').css('display', 'none');

	$('svg > *').each((i, v) => {
		let s = $(v).attr('data-start') * 1;
		let e = $(v).attr('data-end') * 1;

		if (s <= now && now <= e) {
			$(v).css('display', 'block');
		}
	})
}

function pad(str) {
	return str < 10 ? '0'+str : str;
}

function save() {}

function download(type) {

	let $view = $('.view').clone();
	$view.find('*[data-item=item]').each((i, v) => {
		$(v).hide();
	});

	$view.find('*').each((i, v) => {
		if ($(v).attr('data-type') == 'outline') {
			$(v).remove();
		}

		$(v).css('border', '3px solid transparent');
	})

	$view.find('video').attr('src', $('video')[0].src);

	let html = `
		${$view[0].outerHTML}
		<div class='pnp pp'>
			<div class="play" onclick='play()'>재생</div>
			<div class="pause" onclick='pause()'>정지</div>
		</div>
		<style>
			.view {
				
			}

			.pause {
				display: none;
			}

			.play, .pause {
				width: 100px;
				height: 100px;
				background: #dd1e33;
				color: white;
				text-align: center;
				line-height: 100px;
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
			}

			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
				list-style: none;
				word-break: keep-all;
				letter-spacing: -1px;
				user-select: none;
			}

			.hide {
				display: none;
			}

			video {
				width: 100%;
			}

			.view {
				width: 100%;
				min-height: 650px;
				background: #000;
				position: relative;
			}

			.view::after {
				content: 'SCREEN';
				color: white;
				font-family: 'impact';
				font-size: 10rem;
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
				opacity: .05;
				z-index: -10;
			}

			svg {
				position: absolute;
				width: 100%;
				height: 100%;
				left: 0;
				top: 0;
				border: none !important;
			}

			.rap {
				max-width: 1400px;
				width: 100%;
				margin: 0 auto;
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
			}
		</style>

		<script>
			function play() {
				document.querySelector('video').play();
				document.querySelector('.pause').style.display = 'block';
				document.querySelector('.play').style.display = 'none';
				ani();
			}

			function pause() {
				document.querySelector('video').pause();
				document.querySelector('.pause').style.display = 'none';
				document.querySelector('.play').style.display = 'block';
			}

			type = false;

			document.querySelector('.rap').addEventListener('mouseover', function() {
				if (!type) return;
				document.querySelector('.pause').style.opacity = 1;
				document.querySelector('.play').style.opacity = 1;
			})

			document.querySelector('.rap').addEventListener('mouseleave', function() {
				type = true;
				document.querySelector('.pause').style.opacity = 0;
				document.querySelector('.play').style.opacity = 0;
			})

			function ani() {
				requestAnimationFrame(ani);

				let now = document.querySelector('video').currentTime;

				document.querySelectorAll('svg > *').forEach((v, i) => {
					v.style.display = 'none';
				})

				document.querySelectorAll('svg > *').forEach((v, i) => {
					let s = v.getAttribute('data-start') * 1;
					let e = v.getAttribute('data-end') * 1;

					if (s <= now && now <= e) {
						v.style.display = 'block'
					}
				})
			}
		</script>
	`;

	if (type) {
		return html;
	}

	let down = `
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
		</head>
		<body>
			<div class='rap'>
			${html}
			</div>
		</body>
		</html>
	`;

	let blob = new Blob([down], {type: 'text/html'});
	let src = URL.createObjectURL(blob);

	let dt = new Date();
	let y = dt.getFullYear();
	let m = dt.getMonth();
	let d = dt.getDate();

	$('<a>').attr({
		href: src,
		download: `movie-${y}${m}${d}.html`
	})[0].click();
}

function edit() {
	let err = 'none';
	if ($('svg *').length == 0) {
		err = 'sss';
		/*return alert('최소 하나이상의 클립 오브젝트를 생성해주세요.');*/
	}

	let html = download(true);
	video = ($('video').attr('src')+'').replace('.mp4', '-cover.jpg');

	if (video == 'undefined') {
		err = 'sss';
	}

	$.post('/contest', {html, video, err}, function(data) {
		data = JSON.parse(data);

		alert(data[1]);

		if (data[0] == 'error') {
			location='/';
		}
	})
}
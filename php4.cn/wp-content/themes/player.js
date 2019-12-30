let isIncScript = false;
let videoWidth = 720;
let videoHeight = 400;

function script_videojs() {
    if (isIncScript) return;
    isIncScript = true;

    document.writeln(`
    <link href="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/unpkg_video/video-js.css" rel="stylesheet">
	<script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/unpkg_video/video.js"></script>
	<script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/unpkg_video/videojs-flash.js"></script>
    <script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/unpkg_video/videojs-contrib-hls.js"></script>
    `);
}
function script_fluidplayer() {
    if (isIncScript) return;
    isIncScript = true;

    document.writeln(`
    <link rel="stylesheet" href="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/fluidplayer/fluidplayer.min.css" type="text/css"/>
    <script src="https://wo99.oss-cn-qingdao.aliyuncs.com/scripts/fluidplayer/fluidplayer.min.js"></script>
    `);
}

function html_videojs(id, suffix, params) {
    let video = params.video;
    if(suffix) video += '.m3u8';
    document.writeln(`
	<figure class="wp-block-video">
        <div class="site-player" style="width:${videoWidth};height:${videoHeight}">
            <video style="width:100%;height:100%;" id="${id}" class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9" poster="${params.img}" data-setup='{"autoplay":"false"}' controls="" >
            <source src="${video}" type="application/x-mpegURL">
            </video>
            <script>
                (function(window, videojs) {
                    let player = window.player = videojs('${id}', {autoplay:false});
                    let loadUrl = document.getElementById('load-url');
                    let url = document.getElementById('url');
                    if (loadUrl) {
                        loadUrl.addEventListener('submit', function(event) {
                            event.preventDefault();
                            player.src({
                                src: url.value,
                                type: 'application/x-mpegURL'
                            });
                            return false;
                        });
                    }

                    setInterval(()=>{
                        let e = player;
                        let vw = e.videoWidth();
                        let vh = e.videoHeight();
                        if (videoWidth == vw && videoHeight == vh) return;

                        let sitePlayer = document.getElementsByClassName('site-player')[0];
                        if(vw == 0 && vh == 0) return;

                        console.log('视频大小：', vw, vh);
                        sitePlayer.style.width = (vw > vh) ? 720 : 400;
                        sitePlayer.style.height = (vw > vh) ? 400 : 720;

                        videoWidth = vw;
                        videoHeight = vh;
                    }, 100);

                }(window, window.videojs));
            </script>
        </div>
        <figcaption>${params.title}</figcaption>
    </figure>
    `);
}

function html_fluidplayer(id, params) {
    document.writeln(
        `<figure class="wp-block-video">
            <video id="${id}" style="width:100%;height:100%;" poster="${params.img}">
                <script>
                    (function(){
                        let vs${id}='${params.video}'.split(',').reverse();
                        for(let i=0;i<vs${id}.length;i++){
                            let q = vs${id}[i].split('/');
                            q = q[q.length-1];
                            document.writeln('<source src="'+vs${id}[i]+'" title="'+q+'" type="video/mp4">');
                        }
                    });
                </script>
            </video>
            <script> fluidPlayer("${id}"); </script>
            <figcaption>${params.title}</figcaption>
        </figure>`
    );
}

function randomNum() {
    return String(Math.random()).split('.').join('');
}

function dv(params) {
    let source = '';
    if (params.video && params.video.indexOf(',') != -1) {
        let a = params.video.split(',');
        for (let i = 0; i < a.length; i++) {
            source += `<source src="${a[i]}.m3u8" type="application/x-mpegURL">`;
        }
    }

    switch (params.source) {
        case 'ganbi40':
            script_fluidplayer();
            html_fluidplayer('videoId' + randomNum(), params);
            break;
        case '992tv':
            script_videojs();
            html_videojs('videoId' + randomNum(), true, params);
            break;
        default:
            script_videojs();
            html_videojs('videoId' + randomNum(), false, params);
            break;
    }
}


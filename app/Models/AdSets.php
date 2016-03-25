<?php

namespace App\Models;

class AdSets
{
    public static function primary() {
        return new AdSet(
            [
                'leaderboard' => '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px"
                                         data-ad-client="ca-pub-1402299947806334" data-ad-slot="3736645206"></ins>
                                         <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>',
                'banner-right-rail' => '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <ins class="adsbygoogle"
                                             style="display:inline-block;width:336px;height:280px"
                                             data-ad-client="ca-pub-1402299947806334"
                                             data-ad-slot="5213378402"></ins>
                                        <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>',
                'banner-before-content' => '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:inline-block;width:336px;height:280px"
                                                 data-ad-client="ca-pub-1402299947806334"
                                                 data-ad-slot="5073777607"></ins>
                                            <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>',
                'banner-within-content' => '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:inline-block;width:728px;height:90px"
                                                 data-ad-client="ca-pub-1402299947806334"
                                                 data-ad-slot="4654975206"></ins>
                                            <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>',
                'banner-after-content' => '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                            <ins class="adsbygoogle"
                                                 style="display:inline-block;width:728px;height:90px"
                                                 data-ad-client="ca-pub-1402299947806334"
                                                 data-ad-slot="6131708409"></ins>
                                            <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>',
                'content-after-content' => '<div id="rcjsload_83814d"></div>
                                                <script type="text/javascript">
                                                (function() {
                                                var rcel = document.createElement("script");
                                                rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                                rcel.type = \'text/javascript\';
                                                rcel.src = "http://trends.revcontent.com/serve.js.php?w=21388&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                                rcel.async = true;
                                                var rcds = document.getElementById("rcjsload_83814d"); rcds.appendChild(rcel);
                                                })();
                                                </script>',
                'content-right-rail' => '<div id="rcjsload_63e851"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=21389&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_63e851"); rcds.appendChild(rcel);
                                            })();
                                            </script>',
                'inside-content-1' => '<div id="rcjsload_804284"></div>
                                        <script type="text/javascript">
                                        (function() {
                                        var rcel = document.createElement("script");
                                        rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                        rcel.type = \'text/javascript\';
                                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=25525&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                        rcel.async = true;
                                        var rcds = document.getElementById("rcjsload_804284"); rcds.appendChild(rcel);
                                        })();
                                        </script>',
                'inside-content-2' => '<div id="rcjsload_621b07"></div>
                                        <script type="text/javascript">
                                        (function() {
                                        var rcel = document.createElement("script");
                                        rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                        rcel.type = \'text/javascript\';
                                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=25528&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                        rcel.async = true;
                                        var rcds = document.getElementById("rcjsload_621b07"); rcds.appendChild(rcel);
                                        })();
                                        </script>',
                'inside-content-3' => '<div id="rcjsload_870d8b"></div>
                                        <script type="text/javascript">
                                        (function() {
                                        var rcel = document.createElement("script");
                                        rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                        rcel.type = \'text/javascript\';
                                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=25529&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                        rcel.async = true;
                                        var rcds = document.getElementById("rcjsload_870d8b"); rcds.appendChild(rcel);
                                        })();
                                        </script>',
                'inside-content-4' => '<div id="rcjsload_f499f4"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=25530&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_f499f4"); rcds.appendChild(rcel);
                                            })();
                                            </script>',
                'inside-content-5' => '<div id="rcjsload_457952"></div>
                                        <script type="text/javascript">
                                        (function() {
                                        var rcel = document.createElement("script");
                                        rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                        rcel.type = \'text/javascript\';
                                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=25537&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                        rcel.async = true;
                                        var rcds = document.getElementById("rcjsload_457952"); rcds.appendChild(rcel);
                                        })();
                                        </script>',
                'inside-content-6' => '<div id="rcjsload_8c4dc2"></div>
                                        <script type="text/javascript">
                                        (function() {
                                        var rcel = document.createElement("script");
                                        rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                        rcel.type = \'text/javascript\';
                                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=25538&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                        rcel.async = true;
                                        var rcds = document.getElementById("rcjsload_8c4dc2"); rcds.appendChild(rcel);
                                        })();
                                        </script>',
                'inside-content-7' => '<div id="rcjsload_6c01c0"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=25885&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_6c01c0"); rcds.appendChild(rcel);
                                            })();
                                            </script>',
                'inside-content-8' => '<div id="rcjsload_13ab79"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=25886&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_13ab79"); rcds.appendChild(rcel);
                                            })();
                                            </script>',
                'inside-content-9' => '<div id="rcjsload_b2bef3"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=25887&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_b2bef3"); rcds.appendChild(rcel);
                                            })();
                                            </script>',
                'inside-content-10' => '<div id="rcjsload_ba5c74"></div>
                                            <script type="text/javascript">
                                            (function() {
                                            var rcel = document.createElement("script");
                                            rcel.id = \'rc_\' + Math.floor(Math.random() * 1000);
                                            rcel.type = \'text/javascript\';
                                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=25888&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth);
                                            rcel.async = true;
                                            var rcds = document.getElementById("rcjsload_ba5c74"); rcds.appendChild(rcel);
                                            })();
                                            </script>'
            ]);
    }
}
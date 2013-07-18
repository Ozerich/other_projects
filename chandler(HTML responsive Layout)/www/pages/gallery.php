<div id="breadcrumbs">
    <ul>
        <li><a href="#">Departments</a></li>
        <li><a href="#">Landverkehr</a></li>
    </ul>
</div>

<div id="container" class="department-page">


    <div id="content">

        <div class="article-page gallery-page">
            <article>
                <h1>Gallery</h1>

                <? for ($i = 1; $i < 3; $i++): ?>
                <div class="lof-slidecontent gallery">
                    <div class="main-slider-content">
                        <a href="#" class="button-previous"></a>
                        <a href="#" class="button-next"></a>
                        <ul class="sliders-wrap-inner">
                            <li>
                                <img src="/img/gallery/gallery_image_1.jpg">

                                <div class="description">
                                    <h2>Chandler strikes again, leaving all competitor behind</h2>

                                    <p>And here goes your galerie title, with a few information about this project.<br/>Well
                                        yes, and of course you can add a second text line.</p>
                                </div>
                            </li>
                            <li>
                                <img src="/img/gallery/gallery_image_2.jpg">

                            <div </li>
                            <li><img src="/img/gallery/gallery_image_1.jpg"></li>
                            <li><img src="/img/gallery/gallery_image_2.jpg"></li>
                            <li><img src="/img/gallery/gallery_image_1.jpg"></li>
                            <li><img src="/img/gallery/gallery_image_2.jpg"></li>
                        </ul>

                    </div>
                    <div class="navigator-content">
                        <div class="navigator-wrapper">
                            <ul class="navigator-wrap-inner">
                                <li><a href="#"></a>
                                    <i class="darken"></i><img src="/img/gallery/gallery_preview_1.jpg"/>

                                    <div class="description">
                                        <h2>Chandler strikes again, leaving all competitor behind</h2>

                                        <p>And here goes your galerie title, with a few information about this
                                            project.<br/>Well yes, and of course you can add a second text line.</p>
                                    </div>
                                </li>
                                <li><i class="darken"></i><img src="/img/gallery/gallery_preview_2.jpg"/></li>
                                <li><i class="darken"></i><img src="/img/gallery/gallery_preview_3.jpg"/></li>
                                <li><i class="darken"></i><img src="/img/gallery/gallery_preview_4.jpg"/></li>
                                <li><i class="darken"></i><img src="/img/gallery/gallery_preview_5.jpg"/></li>
                                <li><i class="darken"></i><img src="/img/gallery/gallery_preview_6.jpg"/></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <? endfor; ?>

                <div class="paginator">
                    <div class="page-btn"><a href="#" class="icon-prev"></a></div>
                    <div class="page-btn"><a href="#">1</a></div>
                    <div class="page-btn"><a href="#">2</a></div>
                    <div class="page-btn"><a href="#">3</a></div>
                    <div class="page-btn"><a href="#">4</a></div>
                    <div class="spinner">...</div>
                    <div class="page-btn"><a href="#">10</a></div>
                    <div class="page-btn"><a href="#">20</a></div>
                    <div class="page-btn"><a href="#" class="icon-next"></a></div>
                    <br clear="all"/>
                </div>

            </article>
            <div class="article-footer">

                <a href="#" class="icon icon-twitter"></a>
                <a href="#" class="icon icon-fb"></a>
                <a href="#" class="icon icon-in"></a>

                <a href="#" class="icon icon-print"></a>
            </div>
        </div>


    </div>
    <aside>

        <div class="sidebar-category-block">
            <h3 class="block-header">Uber uns</h3>
            <ul>
                <li><a href="#">Philosophie</a></li>
                <li><span>Geschichte</span></li>
                <li><a href="#">AGB & Formulare</a></li>
                <li><a href="#">Referenzen / Kunden</a></li>
                <li><a href="#">Mitglieder stellen sich vor</a></li>
                <li><a href="#">Vereine</a></li>
                <li><a href="#">Karriere</a></li>
            </ul>
        </div>


        <div class="sidebar-auth-block">
            <h3 class="block-header">Login</h3>

            <div class="form"><input type="text" placeholder="Account..."/>
                <input type="password" placeholder="Password..."/>

                <div class="login-row">
                    <label for="remember_me">
                        <input type="checkbox" id="remember_me"/>
                        remember me
                    </label>
                    <button>Login</button>
                </div>
            </div>
        </div>

        <div class="sidebar-video-block"><a href="#"></a></div>

        <div class="sidebar-player-block">
            <h3 class="block-header">Chandler Hymne</h3>

            <div class="player"></div>
        </div>


    </aside>
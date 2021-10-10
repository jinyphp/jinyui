<style>
    /* ###### 7.6 Mail  ###### */
.az-content-mail .container,
.az-content-mail .container-fluid,
.az-content-mail .container-sm,
.az-content-mail .container-md,
.az-content-mail .container-lg,
.az-content-mail .container-xl {
    padding: 20px 0 0;
}

@media (min-width: 992px) {

    .az-content-mail .container,
    .az-content-mail .container-fluid,
    .az-content-mail .container-sm,
    .az-content-mail .container-md,
    .az-content-mail .container-lg,
    .az-content-mail .container-xl {
        padding: 0;
    }
}

@media (min-width: 576px) {
    .az-content-left-mail {
        width: 300px;
    }
}

@media (min-width: 992px) {
    .az-content-left-mail {
        width: 230px;
        display: block;
        padding: 0;
        border-right: 1px solid #cdd4e0;
    }
}

.az-content-left-mail .btn-compose {
    margin-bottom: 20px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 11px;
    padding: 0 20px;
    letter-spacing: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 38px;
}

@media (min-width: 992px) {
    .az-content-left-mail .btn-compose {
        margin-right: 25px;
    }
}

.az-mail-menu {
    position: relative;
    padding-right: 0;
}

@media (min-width: 992px) {
    .az-mail-menu {
        padding-right: 25px;
    }
}

.az-mail-menu .nav-link {
    height: 38px;
}

@media (min-width: 992px) {
    .az-mail-menu .nav-link {
        font-size: 13px;
    }
}

.az-mail-menu .nav-link i {
    font-size: 22px;
}

.az-mail-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding: 0 20px;
}

@media (min-width: 992px) {
    .az-mail-header {
        padding: 0 0 0 25px;
        margin-bottom: 25px;
    }
}

.az-mail-header>div:first-child p {
    font-size: 13px;
    margin-bottom: 0;
}

.az-mail-header>div:last-child {
    display: none;
}

@media (min-width: 768px) {
    .az-mail-header>div:last-child {
        display: flex;
        align-items: center;
    }
}

.az-mail-header>div:last-child>span {
    font-size: 12px;
    margin-right: 10px;
}

.az-mail-header .btn-group .btn,
.az-mail-header .btn-group .sp-container button,
.sp-container .az-mail-header .btn-group button {
    font-size: 21px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    line-height: 0;
    padding: 0;
    position: relative;
    z-index: 1;
    border-color: #cdd4e0;
    background-color: #fff;
}

.az-mail-header .btn-group .btn:hover,
.az-mail-header .btn-group .sp-container button:hover,
.sp-container .az-mail-header .btn-group button:hover,
.az-mail-header .btn-group .btn:focus,
.az-mail-header .btn-group .sp-container button:focus,
.sp-container .az-mail-header .btn-group button:focus {
    color: #1c273c;
    background-color: #f4f5f8;
}

.az-mail-header .btn-group .btn.disabled,
.az-mail-header .btn-group .sp-container button.disabled,
.sp-container .az-mail-header .btn-group button.disabled {
    background-color: #fff;
    color: #cdd4e0;
    border-color: #cdd4e0;
    z-index: 0;
}

.az-mail-header .btn-group .btn.disabled:focus,
.az-mail-header .btn-group .sp-container button.disabled:focus,
.sp-container .az-mail-header .btn-group button.disabled:focus,
.az-mail-header .btn-group .btn.disabled:active,
.az-mail-header .btn-group .sp-container button.disabled:active,
.sp-container .az-mail-header .btn-group button.disabled:active {
    box-shadow: none;
}

.az-mail-header .btn-group .btn+.btn,
.az-mail-header .btn-group .sp-container button+.btn,
.sp-container .az-mail-header .btn-group button+.btn,
.az-mail-header .btn-group .sp-container .btn+button,
.sp-container .az-mail-header .btn-group .btn+button,
.az-mail-header .btn-group .sp-container button+button,
.sp-container .az-mail-header .btn-group button+button {
    margin-left: -2px;
}

.az-mail-options {
    padding: 5px 10px 5px 20px;
    border: 1px solid #cdd4e0;
    border-left-width: 0;
    border-right-width: 0;
    display: none;
    align-items: center;
    justify-content: flex-end;
}

@media (min-width: 992px) {
    .az-mail-options {
        padding-left: 25px;
        display: flex;
        justify-content: space-between;
    }
}

.az-mail-options .btn,
.az-mail-options .sp-container button,
.sp-container .az-mail-options button {
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: transparent;
}

.az-mail-options .btn:hover,
.az-mail-options .sp-container button:hover,
.sp-container .az-mail-options button:hover,
.az-mail-options .btn:focus,
.az-mail-options .sp-container button:focus,
.sp-container .az-mail-options button:focus {
    background-color: #e3e7ed;
}

.az-mail-options .btn i,
.az-mail-options .sp-container button i,
.sp-container .az-mail-options button i {
    line-height: 0;
}

.az-mail-options .btn i.typcn,
.az-mail-options .sp-container button i.typcn,
.sp-container .az-mail-options button i.typcn {
    line-height: .75;
}

.az-mail-options .btn.disabled,
.az-mail-options .sp-container button.disabled,
.sp-container .az-mail-options button.disabled {
    background-color: transparent;
    color: #7987a1;
}

.az-mail-list {
    border-top: 1px solid #e3e7ed;
}

@media (min-width: 992px) {
    .az-mail-list {
        border-top-width: 0;
    }
}

.az-mail-item {
    padding: 10px 15px;
    border-top: 1px solid #e3e7ed;
    border-bottom: 1px solid #e3e7ed;
    background-color: #fcfcfc;
    position: relative;
    display: flex;
    align-items: center;
    width: 100vw;
}

@media (min-width: 576px) {
    .az-mail-item {
        padding: 10px 20px;
    }
}

@media (min-width: 992px) {
    .az-mail-item {
        width: auto;
        padding: 10px 25px;
    }
}

.az-mail-item+.az-mail-item {
    margin-top: -1px;
}

.az-mail-item:first-child {
    border-top-width: 0;
}

.az-mail-item .az-img-user,
.az-mail-item .az-avatar {
    flex-shrink: 0;
    margin-right: 15px;
}

.az-mail-item .az-img-user::after,
.az-mail-item .az-avatar::after {
    display: none;
}

.az-mail-item:hover,
.az-mail-item:focus {
    background-color: #f4f5f8;
}

.az-mail-item.unread {
    background-color: #fff;
}

.az-mail-item.selected {
    background-color: white;
}

.az-mail-checkbox {
    margin-right: 15px;
    display: none;
}

@media (min-width: 992px) {
    .az-mail-checkbox {
        display: block;
    }
}

.az-mail-star {
    margin-right: 15px;
    font-size: 18px;
    line-height: .9;
    color: #cdd4e0;
    position: absolute;
    bottom: 10px;
    right: 0;
}

@media (min-width: 992px) {
    .az-mail-star {
        position: relative;
        bottom: auto;
        top: 2px;
    }
}

.az-mail-star.active {
    color: #ffc107;
}

.az-mail-body {
    width: calc(100% - 80px);
    cursor: pointer;
}

@media (min-width: 992px) {
    .az-mail-body {
        max-width: 460px;
        margin-right: 15px;
        flex: 1;
    }
}

@media (min-width: 1200px) {
    .az-mail-body {
        max-width: 640px;
    }
}

.az-mail-from {
    font-size: 13px;
}

@media (min-width: 576px) {
    .az-mail-subject {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 100%;
    }
}

.az-mail-subject strong {
    font-weight: 700;
    font-size: 14px;
    color: #1c273c;
    display: block;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    width: 100%;
}

@media (min-width: 576px) {
    .az-mail-subject strong {
        display: inline;
        width: auto;
        white-space: normal;
        text-overflow: inherit;
        overflow: visible;
    }
}

.az-mail-subject span {
    font-size: 13px;
    color: #7987a1;
    display: none;
}

@media (min-width: 576px) {
    .az-mail-subject span {
        display: inline;
    }
}

.az-mail-attachment {
    margin-right: 15px;
    font-size: 21px;
    line-height: .9;
    display: none;
}

@media (min-width: 992px) {
    .az-mail-attachment {
        display: block;
    }
}

.az-mail-date {
    font-size: 11px;
    position: absolute;
    top: 12px;
    right: 15px;
    color: #97a3b9;
    margin-left: auto;
}

@media (min-width: 992px) {
    .az-mail-date {
        position: static;
        font-size: 13px;
    }
}

.az-mail-compose {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(28, 39, 60, 0.5);
    z-index: 1000;
    display: none;
}

.az-mail-compose>div {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

@media (min-width: 992px) {
    .az-mail-compose .container {
        padding: 0;
    }
}

.az-mail-compose-box {
    box-shadow: 0 0 30px rgba(28, 39, 60, 0.2);
    border-radius: 3px;
}

.az-mail-compose-header {
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #1c273c;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

@media (min-width: 992px) {
    .az-mail-compose-header {
        padding: 20px 25px;
    }
}

.az-mail-compose-header .nav-link {
    color: rgba(255, 255, 255, 0.3);
    font-size: 14px;
    line-height: 1;
    padding: 0;
    transition: all 0.2s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .az-mail-compose-header .nav-link {
        transition: none;
    }
}

.az-mail-compose-header .nav-link:hover,
.az-mail-compose-header .nav-link:focus {
    color: #fff;
}

.az-mail-compose-header .nav-link+.nav-link {
    margin-left: 15px;
}

.az-mail-compose-header .nav-link:nth-child(2) {
    display: none;
}

@media (min-width: 768px) {
    .az-mail-compose-header .nav-link:nth-child(2) {
        display: block;
    }
}

.az-mail-compose-body {
    background-color: #fff;
    padding: 20px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}

@media (min-width: 992px) {
    .az-mail-compose-body {
        padding: 25px;
    }
}

.az-mail-compose-body .form-group {
    display: flex;
    align-items: center;
}

.az-mail-compose-body .form-group>div {
    flex: 1;
    margin-left: 10px;
}

.az-mail-compose-body .form-group .form-label {
    margin: 0;
    color: #1c273c;
}

.az-mail-compose-body .form-group .form-control {
    border-width: 0;
    border-radius: 0;
    padding: 0;
}

.az-mail-compose-body .form-group .form-control:focus {
    box-shadow: none !important;
}

.az-mail-compose-body .form-group+.form-group {
    border-top: 1px dotted #cdd4e0;
    padding-top: 1rem;
}

.az-mail-compose-body .form-group:last-child {
    display: block;
}

@media (min-width: 576px) {
    .az-mail-compose-body .form-group:last-child {
        display: flex;
        justify-content: space-between;
    }
}

.az-mail-compose-body .form-group:last-child .btn,
.az-mail-compose-body .form-group:last-child .sp-container button,
.sp-container .az-mail-compose-body .form-group:last-child button {
    width: 100%;
    margin-top: 15px;
    padding-left: 20px;
    padding-right: 20px;
}

@media (min-width: 576px) {

    .az-mail-compose-body .form-group:last-child .btn,
    .az-mail-compose-body .form-group:last-child .sp-container button,
    .sp-container .az-mail-compose-body .form-group:last-child button {
        width: auto;
        margin-top: 0;
    }
}

.az-mail-compose-body .form-group .nav-link {
    padding: 0;
    font-size: 18px;
    line-height: 0;
    color: #031b4e;
    position: relative;
    transition: all 0.2s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .az-mail-compose-body .form-group .nav-link {
        transition: none;
    }
}

.az-mail-compose-body .form-group .nav-link:hover,
.az-mail-compose-body .form-group .nav-link:focus {
    color: #1c273c;
}

.az-mail-compose-body .form-group .nav-link+.nav-link {
    margin-left: 15px;
}

.az-mail-compose-compress,
.az-mail-compose-minimize {
    top: auto;
    left: auto;
    bottom: 0;
    right: 30px;
    width: 560px;
    height: auto;
    background-color: transparent;
}

.az-mail-compose-compress .container,
.az-mail-compose-minimize .container {
    max-width: none;
    padding: 0;
}

.az-mail-compose-minimize .az-mail-compose-body {
    display: none;
}

/* ###### 7.7 Mail Two  ###### */
.az-mail-two .az-content {
    display: flex;
    flex-direction: column;
}

.az-mail-two .az-header {
    width: 100%;
    border-bottom: 1px solid #cdd4e0;
}

.az-mail-two .az-footer {
    width: 100%;
}

.az-mail-two .az-header-menu-icon {
    margin-right: 0;
}

.az-mail-two .az-content-body {
    display: flex;
    padding: 0;
}

.az-mail-left {
    background-color: #f9f9f9;
    width: 240px;
    border-right: 1px solid #b4bdce;
    padding: 20px;
    display: none;
}

@media (min-width: 1200px) {
    .az-mail-left {
        display: block;
    }
}

.az-mail-left .btn-compose {
    display: block;
    margin-bottom: 20px;
}

.az-mail-left .az-mail-menu {
    padding-right: 0;
}

.az-mail-content {
    background-color: #fcfcfc;
    flex: 1;
    max-width: 100vw - 480px;
}

.az-mail-content .az-mail-header {
    margin-bottom: 0;
    padding: 20px;
}

.az-mail-content .az-mail-body {
    max-width: 590px;
}

</style>
<x-theme-app>
    <div class="az-content az-content-mail">
        <div class="container">
            <div class="az-content-left az-content-left-mail">

                <div class="az-content-header">
                    <a href="" id="azMenuShow" class="az-header-menu-icon"><span></span></a>
                    <a href="index.html" class="az-logo">az<span>i</span>a</a>
                    <a href="" id="azContentLeftHide" class="az-header-arrow">
                        <i class="icon ion-md-arrow-forward d-sm-none"></i>
                        <i class="icon ion-md-close d-none d-sm-block"></i>
                    </a>
                </div><!-- az-content-header -->

                <a id="btnCompose" href="" class="btn btn-az-primary btn-compose">Compose</a>
                <div class="az-mail-menu">
                    <nav class="nav az-nav-column mg-b-20">
                        <a href="" class="nav-link active"><i class="typcn typcn-mail"></i> Inbox <span>20</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-star-outline"></i> Starred <span>3</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-bookmark"></i> Important <span>10</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-arrow-forward-outline"></i> Sent Mail
                            <span>8</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-pen"></i> Drafts <span>15</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-cancel-outline"></i> Spam <span>128</span></a>
                        <a href="" class="nav-link"><i class="typcn typcn-trash"></i> Trash <span>6</span></a>
                    </nav>

                    <label class="az-content-label az-content-label-sm">Label</label>
                    <nav class="nav az-nav-column mg-b-20">
                        <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> Social <span>10</span></a>
                        <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> Promotions <span>22</span></a>
                        <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> Updates <span>17</span></a>
                    </nav>

                    <label class="az-content-label az-content-label-sm">Tags</label>
                    <nav class="nav az-nav-column mg-b-20">
                        <a href="#" class="nav-link"><i class="typcn typcn-social-twitter-circular"></i> Twitter
                            <span>2</span></a>
                        <a href="#" class="nav-link"><i class="typcn typcn-social-github-circular"></i> Github
                            <span>32</span></a>
                        <a href="#" class="nav-link"><i class="typcn typcn-social-google-plus-circular"></i> Google
                            <span>7</span></a>
                    </nav>
                </div><!-- az-mail-menu -->
            </div><!-- az-content-left -->
            <div class="az-content-body az-content-body-mail">
                <div class="az-mail-header">
                    <div>
                        <h4 class="az-content-title mg-b-5">Inbox</h4>
                        <p>You have 2 unread messages</p>
                    </div>
                    <div>
                        <span>1-50 of 1200</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary disabled"><i
                                    class="icon ion-ios-arrow-back"></i></button>
                            <button type="button" class="btn btn-outline-secondary"><i
                                    class="icon ion-ios-arrow-forward"></i></button>
                        </div>
                    </div>
                </div><!-- az-mail-list-header -->
                <div class="az-mail-options">
                    <label class="ckbox">
                        <input id="checkAll" type="checkbox">
                        <span></span>
                    </label>
                    <div class="btn-group">
                        <button class="btn btn-light"><i class="typcn typcn-arrow-sync"></i></button>
                        <button class="btn btn-light disabled"><i class="typcn typcn-archive"></i></button>
                        <button class="btn btn-light disabled"><i class="typcn typcn-info-outline"></i></button>
                        <button class="btn btn-light disabled"><i class="typcn typcn-trash"></i></button>
                        <button class="btn btn-light disabled"><i class="typcn typcn-folder"></i></button>
                        <button class="btn btn-light disabled"><i class="typcn typcn-tag"></i></button>
                    </div><!-- btn-group -->
                </div><!-- az-mail-options -->

                <div class="az-mail-list">
                    <div class="az-mail-item unread">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face1.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Adrian Monino</div>
                            <div class="az-mail-subject">
                                <strong>Someone who believes in you</strong>
                                <span>enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget
                                    dolor cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-attachment"><i class="typcn typcn-attachment"></i></div>
                        <div class="az-mail-date">11:30am</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item unread">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star active">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Albert Ansing</div>
                            <div class="az-mail-subject">
                                <strong>Here's What You Missed This Week</strong>
                                <span>enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget
                                    dolor cum socia eget dolor...</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">06:50am</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Carla Guden</div>
                            <div class="az-mail-subject">
                                <strong>4 Ways to Optimize Your Search</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-attachment"><i class="typcn typcn-attachment"></i></div>
                        <div class="az-mail-date">Yesterday</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item unread">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face3.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Reven Galeon</div>
                            <div class="az-mail-subject">
                                <strong>We're Giving a Macbook for Free</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Yesterday</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face4.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Elisse Tan</div>
                            <div class="az-mail-subject">
                                <strong>Keep Your Personal Data Safe</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 13</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Marianne Audrey</div>
                            <div class="az-mail-subject">
                                <strong>We've Made Some Changes</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 13</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-avatar bg-gray-800">J</div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Jane Phoebe</div>
                            <div class="az-mail-subject">
                                <strong>Grab Our Holiday Deals</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 12</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face6.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Raffy Godinez</div>
                            <div class="az-mail-subject">
                                <strong>Just a Few Steps Away</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 05</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star active">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face7.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Allan Cadungog</div>
                            <div class="az-mail-subject">
                                <strong>Credit Card Promos</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 04</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face8.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Alfie Salinas</div>
                            <div class="az-mail-subject">
                                <strong>4 Ways to Optimize Your Search</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 02</div>
                    </div><!-- az-mail-item -->
                    <div class="az-mail-item">
                        <div class="az-mail-checkbox">
                            <label class="ckbox">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        </div><!-- az-mail-checkbox -->
                        <div class="az-mail-star">
                            <i class="typcn typcn-star"></i>
                        </div><!-- az-mail-star -->
                        <div class="az-img-user"><img src="../img/faces/face9.jpg" alt=""></div>
                        <div class="az-mail-body">
                            <div class="az-mail-from">Jove Guden</div>
                            <div class="az-mail-subject">
                                <strong>Keep Your Personal Data Safe</strong>
                                <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor
                                    cum socia eget dolor</span>
                            </div>
                        </div><!-- az-mail-body -->
                        <div class="az-mail-date">Oct 02</div>
                    </div><!-- az-mail-item -->
                </div><!-- az-mail-list -->

                <div class="mg-lg-b-30"></div>

            </div><!-- az-content-body -->
        </div><!-- container -->
    </div>
</x-theme-app>

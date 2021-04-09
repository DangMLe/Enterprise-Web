
export default function Header() {
    return (
        <>
            <header id="header">
                <div className="wrap">
                    <div className="menu-hambeger">
                        <div className="button">
                            <span />
                            <span />
                            <span />
                        </div>
                        <span className="text">menu</span>
                    </div>
                    <a href="#" className="logo">
                    </a>
                    <div className="right">
                        <div className="have-login">
                            <div className="account">
                                <a href="#" className="info">
                                    <div className="name"></div>
                                    <div className="avatar">
                                        <img src="/img/avt.png" alt="" />
                                    </div>
                                </a>
                            </div>
                            <div className="hamberger">
                            </div>
                            <div className="sub">
                                <a href="#">Profile</a>
                                <a href="#">Account</a>
                                <a href="#">Sign Out</a>
                            </div>
                        </div>
                        {/* <div class="not-login bg-none">
                        <a href="#" class="btn-register">Đăng nhập</a>
                        <a href="login.html" class="btn main btn-open-login">Đăng ký</a>
                    </div> */}
                    </div>
                </div>
            </header>
            <nav className="nav">
                <ul>
                    <li className="li_login">
                        <a href="#">Đăng nhập</a>
                        <a href="#">Đăng ký</a>
                    </li>
                    <li className="active">
                        <a href="#">Blog</a>
                    </li>
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">User</a>
                    </li>
                    <li>
                        <a href="#">Student</a>
                    </li>
                    <li>
                        <a href="#">Calender</a>
                    </li>
                </ul>
            </nav>
            <div className="overlay_nav" />
        </>
    )
}

import Course from "./components/Course";
import Header from "../../components/Header";
import Footer from "../../components/Footer";


export default function index() {
    return (
        <div>
          <Header />
            <main className="homepage" id="main">
                <section className="section-courseoffline">
                    <div className="container">
                        <div className="textbox">
                            <h2 className="main-title">DASHBOARD</h2>
                        </div>
                        <p className="top-des">
                            The readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it
                            has
                            a more-or-less normal
                        </p>
                        <div className="list row">
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                            <Course name="" des="" status="" image="" teacher_img="" teacher_name=""/>
                        </div>
                    </div>
                </section>
            </main>
            <div className="popup-form popup-login" style={{ display: 'none' }}>
                <div className="wrap">
                    <div className="ct_login" style={{ display: 'block' }}>
                        <h2 className="title">Đăng nhập</h2>
                        <input type="text" placeholder="Email / Số điện thoại" />
                        <input type="password" placeholder="Mật khẩu" />
                        <div className="remember">
                            <label className="btn-remember">
                                <div>
                                    <input type="checkbox" />
                                </div>
                                <p>Nhớ mật khẩu</p>
                            </label>
                            <a href="#" className="forget">Quên mật khẩu?</a>
                        </div>
                        <div className="btn rect main btn-login">đăng nhập</div>
                        <div className="text-register" style={{}}>
                            <strong>hoặc đăng ký bằng</strong>
                        </div>
                        <div>
                            <div className="btn btn-icon rect white btn-google">
                                <img src="/img/google.svg" alt="" />
                                Google
                            </div>
                        </div>
                        <div className="close">
                            <img src="/img/close-icon.png" alt="" />
                        </div>
                    </div>
                    {/* email form */}
                    <div className="ct_email">
                        <h2 className="title">Đặt lại mật khẩu</h2>
                        <input type="text" placeholder="Email" />
                        <div className="btn rect main btn-next">Tiếp theo</div>
                        <div className="back" />
                        <div className="close">
                            <img src="/img/close-icon.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div className="popup-form popup-login" style={{ display: 'none' }}>
                <div className="wrap">
                    <h2 className="title">Đăng ký</h2>
                    <div className="btn btn-icon rect white btn-google">
                        <img src="/img/google.svg" alt="" />
                        Google
                    </div>
                    <p className="policy">
                        Bằng việc đăng kí, bạn đã đồng ý <a href="#">Điều khoản bảo mật</a> của CFD
                    </p>
                    <div className="close">
                        <img src="/img/close-icon.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    )
}

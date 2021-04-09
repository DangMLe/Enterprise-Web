import React, { Component } from "react";
import "../scss/Login.scss";

export default function index() {
  return (
    <div className="Login">
      <div className="container-login100">
        <div className="wrap-login100">
          <form className="login100-form validate-form">
            <span className="login100-form-title p-b-26">
              <strong>SIGN IN</strong>
            </span>
            <span className="login100-form-title p-b-48">
              <i className="zmdi zmdi-font" />
            </span>
            <div className="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
              <input className="input100" type="text" name="email" placeholder="Email" />
              <span className="focus-input100" />
            </div>
            <div className="wrap-input100 validate-input" data-validate="Enter password">
              <span className="btn-show-pass">
                <i className="zmdi zmdi-eye" />
              </span>
              <input className="input100" type="password" name="pass" placeholder="Password" />
              <span className="focus-input100" />
            </div>
            <div className="container-login100-form-btn">
              <div className="wrap-login100-form-btn">
                <div className="login100-form-bgbtn" />
                <button className="login100-form-btn">
                  SIGN IN
                  </button>
                {/* <AdminHome /> */}
              </div>
            </div>
            <div className="text-center p-t-115">
              <a className="txt2" href="#">
                Forgetten my password
                </a>
              <div className="container-login101-form-btn">
                <div className="wrap-login101-form-btn">
                  <div className="login101-form-bgbtn" />
                  <button className="login101-form-btn">
                    Sign in as Guest
                    </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}


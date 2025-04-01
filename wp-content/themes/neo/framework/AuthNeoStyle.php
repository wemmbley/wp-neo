<?php

namespace Neo\Framework;

class AuthNeoStyle
{
	public function __construct()
	{
		add_action( 'login_enqueue_scripts', function () {
			?>
			<style>
                body {
                    position: relative;
                }
                body::before {
                    content: '';
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/framework/Resources/img/palms.png);
                    background-position: center center;
                    background-attachment: fixed;
                    background-repeat: no-repeat;
                    background-size: cover;
                    filter: blur(3px) brightness(90%);
                    z-index: -1;
                }
                #login-message {
                    backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.2); /* Белый с прозрачностью */
                    border: 1px solid rgba(255, 255, 255, 0.3); /* Легкая граница */
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.09);
                    border-radius: 4px;
                }
                #loginform {
                    backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.2); /* Белый с прозрачностью */
                    border: 1px solid rgba(255, 255, 255, 0.3); /* Легкая граница */
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.09);
                    border-radius: 4px;
                }
                #loginform input:not(:placeholder-shown),
                #loginform input:-webkit-autofill {
                    backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.2) !important; /* Принудительно применяем фон */
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.04);
                    transition: background-color 5000s ease-in-out 0s; /* Хак для обхода автостилей Chrome */
	                border-radius: 4px;
	                padding-left: 10px !important;
                }
                input[type=checkbox]:checked::before {
	                margin: -4px 0 0 -13px !important;
                }
                #loginform #wp-submit {
	                display: grid;
	                width: 100px;
                    cursor: pointer;
                    transition: ease 0.27s;
	                color: #252525;
	                height: 32px;
	                margin-top: 6px !important;
                    backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.1); /* Белый с прозрачностью */
                    border: 1px solid rgba(255, 255, 255, 0.3); /* Легкая граница */
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.09);
                    border-radius: 4px;
                }
                #loginform #wp-submit:hover {
                    transition: ease 0.27s;
	                transform: translateY(-5px);
                }
                .forgetmenot {
	                margin-top: 8px !important;
                }
                body.login div#login h1 a {
                    background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/framework/Resources/img/neo.png);
                    margin-left: 0px;
                    width: 400px;
	                height: 130px;
                    padding-bottom: 0px;
                    margin-bottom: 0px;
                    background-attachment: scroll;
                    background-repeat: no-repeat;
                    background-position: center top;
                    background-size: auto;
                    filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.1));
                }
			</style>
			<?php
		});


		add_filter( 'login_headerurl', function () {
			return get_bloginfo( 'url' );
		});


		add_filter( 'login_headertitle', function () {
			return 'my_login_logo_url_title';
		});
	}
}
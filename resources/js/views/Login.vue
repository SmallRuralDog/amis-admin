<template>
    <div class="login-page">
        <div class="page-account">
            <div class="page-account-container">
                <div class="page-logo">
                    <img v-if="config.loginLogo" :src="config.loginLogo" alt="">
                    <b v-else class="logo-name">{{config.name}}</b>
                </div>
                <div class="page-title" v-html="config.loginDesc"></div>
                <div class="page-account-top"></div>

                <div class="amis-login">
                    <AMisPage/>
                </div>
            </div>
            <footer class="i-copyright">
                <div class="copyright-links">
                    <a target="_blank" :href="a.href" v-for="a in config.footerLinks">{{a.title}}</a>
                </div>
                <div class="copyright-text" v-html="config.copyright"></div>
            </footer>
        </div>
    </div>
</template>

<script setup lang="ts">
import AMisPage from "@/views/AMisPage.vue";
import {useAmisAdminStore} from "@/stores/admin";

const {config} = useAmisAdminStore()

</script>

<style lang="scss">
.login-page {
    min-height: 100vh;
    background: #f9f9f9;
    color: #808695;
    padding: 20px;
    display: flex;
    flex-direction: column;

    &, &:before, &:after, *, *:before, *:after {
        box-sizing: border-box;
    }

    .page-account {
        transform: translateY(0);
        z-index: 1;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .page-account-container {
        flex: 1;
        min-width: 300px;
        margin: 15vh auto 0;
        max-width: 100%;
        width: 384px;

        .page-logo {
            margin: 0 auto 10px;
            display: flex;
            justify-content: center;
            .logo-name{
                font-size: 40px;
            }
            img {
                height: 75px;
                object-fit: contain;
            }
        }

        .page-title {
            text-align: center;
            margin: 0 auto 40px;
            font-size: 12px;
        }
    }

    footer {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        font-size: 12px;

        .copyright-links {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;

            a {
                color: inherit;
                text-decoration: none;
                margin: 0 16px;

                &:hover {
                    color: #000000;
                }
            }
        }

        .copyright-text {
            text-align: center;
        }
    }

    .cxd-TextControl-input {
        padding: 12px 8px;
        font-size: 15px;
    }
}
</style>

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const axios = require('axios');
const Swal = require('sweetalert2')

window.Vue = require('vue');
Vue.prototype.$axios = axios.create({'baseURL': '/api'});

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('code_list', require('./components/CodeList').default);
Vue.component('code_editor', require('./components/CodeEditor').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {}
    },
    mounted() {
        jQuery('[data-toggle="tooltip"]').tooltip();
    },
    methods: {
        deletePM(pm_id) {
            Swal.fire({
                text: '确定要删除这条私信吗？',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认',
                cancelButtonText: '取消'
            }).then((res) => {
                if (res.value === true) {
                    let data = {'id' : pm_id}
                    this.$axios.post('pm/delete',data).then((res) => {
                      window.location.href = '/pm'
                    })
                }
            });
        },
        sendPM() {
            Swal.fire({
                text: '确定要把这条私信发送给对方吗？',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认',
                cancelButtonText: '取消'
            }).then((res) => {
                if (res.value === true) {
                    let data = {'content': this.$refs['content'].value, 'receiver_id': this.$refs['receiver_id'].value}
                    this.$axios.post('pm/send', data).then((res) => {
                        Swal.fire(
                            '发送成功',
                            '您的消息成功发送给对方',
                            'success'
                        ).then(() => {
                            window.location.href = '/';
                        })
                    }).catch(error => {
                        for (let obj of Object.keys(error.response.data.errors)) {
                            Swal.fire(
                                '提交失败',
                                error.response.data.errors[obj][0],
                                'error'
                            )
                        }
                    })
                }
            });
        }
    }
});

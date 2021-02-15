new Vue({
    el: '#app',
    data: {
        step: 1,
        email: '',
        password: '',
        token: '',
        userId: -1,
        message: ''
    },
    methods: {
        firstAuth() {

            this.message = '';

            const url = '/ajax/two_factor_auth/first_auth';
            const params = {
                email: this.email,
                password: this.password
            };
            axios.post(url, params)
                .then(response => {

                    const result = response.data.result;

                    if(result) {
                        this.userId = response.data.user_id;
                        this.step = 2;
                    } else {
                        this.message = 'ログイン情報が間違っています。';
                    }

                });

        },
        secondAuth() {

            const url = '/ajax/two_factor_auth/second_auth';
            const params = {
                user_id: this.userId,
                tfa_token: this.token
            };

            axios.post(url, params)
                .then(response => {

                    const result = response.data.result;

                    if(result) {

                        // ２段階認証成功
                        location.href = '/home';

                    } else {

                        this.message = '２段階パスワードが正しくありません。';
                        this.token = '';

                    }

                });

        }
    }
});

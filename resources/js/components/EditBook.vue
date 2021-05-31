<template>
    <div>
        <h4 class="text-center">Edit Contact</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook" novalidate="true">
                    <div class="alert alert-danger" role="alert" v-if="errors !== null">
                        <p v-if="errors.length">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Full name</label>
                        <input type="text" class="form-control" v-model="book.full_name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="book.email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" v-model="book.phone">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: null,
            book: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/books/edit/${this.$route.params.id}`)
                .then(response => {
                    this.book = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateBook() {
            if (this.checkForm()){
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post(`/api/books/update/${this.$route.params.id}`, this.book)
                        .then(response => {
                            this.success = response.data.message
                            this.$swal(this.success);
                            this.$router.push({name: 'books'});
                        })
                        .catch(function (error) {
                            this.error = error.data.message
                            this.$swal(this.error);
                        });
                })
            }
        },
        checkForm: function (e) {
            if (this.book.full_name && this.book.email && this.book.phone && !isNaN(this.book.phone) && this.validEmail(this.book.email)) {
                return true;
            }
            this.errors = [];

            if (!this.book.full_name) {
                this.errors.push('The full name field is required!');
            }
            if (!this.book.email) {
                this.errors.push('The email field is required!');
            } else if (!this.validEmail(this.book.email)) {
                this.errors.push('Enter correct email address!');
            }
            if (!this.book.phone) {
                this.errors.push('The phone field is required');
            }
            if (isNaN(this.book.phone)){
                this.errors.push('Please enter valid phone!')
            }
            // e.preventDefault()
        },

        validEmail: function (email) {
            let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>

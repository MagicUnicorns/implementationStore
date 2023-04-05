<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component test. User id is {{userId}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('Component mounted, user id = ' + this.userId + '.')
            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("message is here and it says1:");
                    console.log(message);
                })
                .listen('PaymentRequestNotification', (message) => {
                    console.log("message is here and it says2: ");
                    console.log(message);
                });
        }
    }
</script>

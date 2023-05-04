<template>
    <div class="request-container">
        <div class="header">
            <h2>Request</h2>
        </div>
        <p>The <b>request</b> to the <code>/payments</code> endpoint will be shown here.</p>
        <pre class="request-code" id="request-code"></pre>
    </div>
</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('PaymentsBodyComponent mounted, user id = ' + this.userId + '.')
            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("Message is here (request component):");
                    console.log(message);
                })
                .listen('PaymentRequestNotification', (message) => {
                    console.log("PaymentRequestNotification is here: ");
                    console.log(message);
                    document.getElementById('request-code').innerHTML = JSON.stringify(JSON.parse(message.message),null,4);
                });
        }
    }
</script>

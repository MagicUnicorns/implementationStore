<template>
    <div class="request-container">
        <div class="header">
            <h2>Details</h2>
        </div>
        <p>The <b>request</b> for the <code>/payments/details</code> endpoint will be shown here.</p>
        <pre class="payments-details-request-code" id="payments-details-request-code"></pre>
    </div>

</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('PaymentsDetailsRequestComponent mounted, user id = ' + this.userId + '.')
            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("message is here (details component):");
                    console.log(message);
                })
                .listen('PaymentDetailsRequestNotification', (message) => {
                    console.log("PaymentDetailsRequestNotification is here: ");
                    console.log(message);
                    document.getElementById('payments-details-request-code').innerHTML = JSON.stringify(JSON.parse(message.message),null,4);
                });
        }
    }
</script>

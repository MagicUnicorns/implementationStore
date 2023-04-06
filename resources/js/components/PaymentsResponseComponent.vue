<template>
    <div class="container">
        <div class="row">
            <!-- <div class="card">
                <div class="card-header">Example Component</div>

                <div class="card-body">
                    I'm an example component test. User id is {{userId}}
                </div>
            </div> -->

            <div class="response-container">
              <div class="header">
                  <h2>Response</h2>
              </div>
              <p>The <b>response</b> from the <code>/payments</code> endpoint will be shown here.</p>
              <pre class="response-code" id="response-code"></pre>
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
                    console.log("message is here and it response component:");
                    console.log(message);
                })
                .listen('PaymentResponseNotification', (message) => {
                    console.log("PaymentResponseNotification is here and it says: ");
                    console.log(message);
                    document.getElementById('response-code').innerHTML = JSON.stringify(JSON.parse(message.message),null,4);
                });
        }
    }
</script>

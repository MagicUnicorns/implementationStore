<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button class="btn btn-primary ml-4" @click="samplePayment">sample payment</button>
            </div>
        </div>
        <div class="row justify-content-center" id="tempResultId">
            <div class="col-md-8">
                {{ result }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                result: "Nix"
            }
        },
        mounted() {
            console.log('PaymentsComponent mounted.')
        },
        methods: {
            samplePayment(){
                axios.post('/payments')
                    .then(response => {
                        this.result = JSON.stringify(response, 1, 4);
                    });
            }
        }
    }
</script>

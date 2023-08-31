<template>
    <div>
        <div class="container w-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">Dialpad</div>

                        <div class="card-body">
                            <input type="text" name="number" v-model="callNumber" class="form-control text-center mb-2"
                                placeholder="932 2929 292" readonly>
                            <div class="row justify-content-around">
                                <dial-pad-button digit="1" characters="" @click="appendCallNumber(1)"></dial-pad-button>
                                <dial-pad-button digit="2" characters="ABC" @click="appendCallNumber(2)"></dial-pad-button>
                                <dial-pad-button digit="3" characters="DEF" @click="appendCallNumber(3)"></dial-pad-button>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <dial-pad-button digit="4" characters="GHI" @click="appendCallNumber(4)"></dial-pad-button>
                                <dial-pad-button digit="5" characters="JKL" @click="appendCallNumber(5)"></dial-pad-button>
                                <dial-pad-button digit="6" characters="MNO" @click="appendCallNumber(6)"></dial-pad-button>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <dial-pad-button digit="7" characters="PQRS" @click="appendCallNumber(7)"></dial-pad-button>
                                <dial-pad-button digit="8" characters="TUV" @click="appendCallNumber(8)"></dial-pad-button>
                                <dial-pad-button digit="9" characters="WXYZ" @click="appendCallNumber(9)"></dial-pad-button>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <dial-pad-button digit="*" characters="" @click="appendCallNumber('*')"></dial-pad-button>
                                <dial-pad-button digit="0" characters="" @click="appendCallNumber(0)"></dial-pad-button>
                                <dial-pad-button digit="#" characters="&nbsp;"
                                    @click="appendCallNumber('#')"></dial-pad-button>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <button type="button" class="btn btn-success col-11" @click="call">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        style="fill: rgb(13 76 39);transform: ;msFilter:;">
                                        <path
                                            d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const toast = useToast()

export default {
    data() {
        return {
            callNumber: "",
            error: "",
            modal: null
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        appendCallNumber(digit) {
            this.callNumber += digit
        },
        call() {
            if( this.callNumber.length > 10 ) {
                this.error = ""

                $.ajax({
                    url: "/api/dialpad",
                    method: "post",
                    data: {
                        number: this.callNumber
                    },
                    dataType: "json",
                    success(response) {
                        if (response?.success) {
                            toast.success("Dialing... " + response?.number, {
                                position: "top-right"
                            })
                        }
                    },
                    error(error) {
                        console.error(error)
                    }
                })
            } else {
                this.error = "Enter at least 10 digits"
                toast.error(this.error, {
                    position: "top-right"
                })
            }
        }
    }
}
</script>

<style lang="sass" scoped>
    .container
        height: 100vh !important
    
    .card-header
        background-color: #444
        border-color: #222
        color: #fff
        font-size: 1.2rem
    
    .card
        border-color: #222

    .card-body
        background-color: #333

    input, input:focus
        background-color: #345
        border-color: #234
        color: #fff
        font-size: 1.3rem
</style>

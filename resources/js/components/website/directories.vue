<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-12 pt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 border shadow p-5">
                            <h4 class="font-weight-bold text-center mb-4 color-red"> COLLEGE ACADEMIC OFFICERS AND STAFFERS </h4>
                            <div class="mb-4" v-for="head in cba_heads" :key="head.id">
                                <h6 class="font-weight-bold color-blue-green mb-0">{{ head.position }}</h6>
                                <div class="d-flex justify-content-between mobile-view">
                                    <div>{{ head.name }}</div>
                                    <div>{{ head.email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 border shadow p-5 other-box-height">
                            <h4 class="font-weight-bold text-center mb-4 color-yellow"> CBA Student Council A.Y. 2021-2022 </h4>
                            <div class="row d-flex justify-content-around mt-5">
                                <a href="https://www.facebook.com/ue.cbasc" target="_blank"><img src="images/fb.svg" class="social-icons" alt="fb-icon"></a>
                                <a href="https://www.instagram.com/uemnl_cbasc" target="_blank"><img src="images/ig.svg" class="social-icons" alt="ig-icon"></a>
                                <a href="https://twitter.com/uemnl_cbasc" target="_blank"><img src="images/twitter.svg" class="social-icons" alt="twitter-icon"></a>
                                <img src="images/gmail.svg" class="social-icons" alt="gmail-icon">
                            </div>
                            <h5 class="font-weight-bold mt-5 text-center color-blue-green"> Join our CBA Discord Server </h5>
                            <!-- <a href="https://bit.ly/UEMlaCBA21-22" target="_blank"><h6 class="text-center">Click Here</h6></a> -->
                            <a href="https://bit.ly/UEMlaCBA21-22" target="_blank"><img src="images/discord.png" height="100%" width="100%" alt="mountains" class="mt-2"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cba_heads: [
                {
                    position: 'College Dean',
                    name: 'Veronica N. ELIZALDE',
                    email: 'veronica.elizalde@ue.edu.ph '
                },
                {
                    position: 'Associate Dean',
                    name: 'Angelito C. DESCALZO',
                    email: 'angelito.descalzo@ue.edu.ph'
                },
                {
                    position: 'College Secretary',
                    name: 'Ofelia D. NILO',
                    email: 'ofelia.nilo@ue.edu.ph'
                },
                {
                    position: 'Department Chair, Accountancy, Business Law and Taxation (ACLAT)',
                    name: 'Joseph Y. CO',
                    email: 'joseph.co@ue.edu.ph'
                },
                {
                    position: 'Department Chair, Marketing, Behavioral Science, Computer and Management (MARBECMAN)',
                    name: 'Marissa L. LANUZA',
                    email: 'marissa.lanuza@ue.edu.ph'
                },
                {
                    position: 'Department Chair, Finance, Economics and Business Mathematics (FECOMATH)',
                    name: 'Carolyn DG. CASTILLO',
                    email: 'carolyn.castillo@ue.edu.ph'
                },
                {
                    position: 'Department Chair, Entreprenuerial Venture and Student Apprenticeship (EVSA)',
                    name: 'Cynthia A. ABELLA',
                    email: 'cynthia.abella@ue.edu.ph'
                },
                {
                    position: 'Administrative Assistant',
                    name: 'Nora R. RODRIGUEZ',
                    email: 'nora.rodriguez@ue.edu.ph'
                },
                {
                    position: 'Office Assistant',
                    name: 'Dandel T. MONTAYRE',
                    email: 'dandel.montayre@ue.edu.ph'
                },
                {
                    position: 'Academic Records Evaluator II',
                    name: 'Ernesto M. COLIBAO, Jr.',
                    email: 'ernesto.colibao@ue.edu.ph'
                },
                {
                    position: 'Academic Records Evaluator I',
                    name: 'Khaterine V. IGNACIO',
                    email: 'khaterine.ignacio@ue.edu.ph'
                },
                {
                    position: 'Messenger-Clerk',
                    name: 'Delpman P. DATU MAMADRA',
                    email: 'delpman.datumamadra@ue.edu.ph'
                },
                {
                    position: 'Clerical Aide',
                    name: 'Denand Kay M. ASUNCION',
                    email: 'denandkay.asuncion@ue.edu.ph'
                }
            ]
        }
    },
    methods: {
        check() {
            console.log(this.cba_heads)
        }
    },
    mounted() {
        this.check();
    }
}
</script>

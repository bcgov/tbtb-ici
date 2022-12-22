<script setup>

defineProps({
    loginAttempt: Boolean,
    hasAccess: Boolean,
    status: String,
});
// defineComponent( {
//     Head
// });
</script>
<style scoped>
.bg-bc-gov{
    background: none;
    background-color: #036;
    font-family: 'BCSans', 'Noto Sans', Verdana, Arial, sans-serif;
    color: #036;
}
</style>
<template>
    <div class="min-h-screen text-center flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-bc-gov">

        <Head><title>Select Application</title></Head>
        <h2 class="text-center text-white">Welcome <span v-if="$attrs['auth']['user']">{{ $attrs['auth']['user']['first_name'] }}</span></h2>
        <p class="text-center text-white">Please select an application to log into</p>

        <div v-if="status" class="alert mb-4 font-medium text-sm alert-danger">
            {{ status }}
        </div>

        <div class="row col-12 m-3 justify-content-center">
            <div class="col-md-3">
                <a :href="route('students.index')" class="card p-5 text-dark" style="text-decoration:none;">
                    <h1 class="display-3 font-sans font-light">ICI</h1>
                    <span>Youth Educational Assistance Fund</span>
                </a>
            </div>
            <div class="col-md-3">
                <a :href="route('twp.students.index')" class="card p-5 text-dark" style="text-decoration:none;">
                    <h1 class="display-3 font-sans font-light">TWP</h1>
                    <span>Tuition Waiver Program</span>
                </a>
            </div>
        </div>
    </div>
</template>

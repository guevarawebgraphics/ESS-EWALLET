<template>
   <!-- footer area start-->
 <footer>
        <div class="footer-area">
            <p>© Copyright {{ currentYear }}. All right reserved CSI</p>
        </div>
    </footer>
<!-- footer area end-->
</template>

<script>
export default {
    data(){
        return {
            currentYear: new Date().getFullYear(),
        }
    }
}
</script>

<style>
.footer-area {
    background-color: #F3F8FB;
}
</style>
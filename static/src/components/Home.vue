<template>
    <div>
        <vue-particles
                color="#dedede"
                :particleOpacity="0.7"
                :particlesNumber="80"
                shapeType="circle"
                :particleSize="4"
                linesColor="#dedede"
                :linesWidth="1"
                :lineLinked="true"
                :lineOpacity="0.4"
                :linesDistance="150"
                :moveSpeed="3"
                :hoverEffect="true"
                hoverMode="grab"
                :clickEffect="true"
                clickMode="push"
        >
        </vue-particles>
        <div class="footer-t">
            <span><a href="http://www.beian.miit.gov.cn">浙ICP备19006658</a></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App'
    }
</script>

<style>
    #particles-js {
        background-image: url("./../assets/sky.jpg");
        background-size: cover;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .footer-t {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 30px;
        text-align: center;
    }
</style>

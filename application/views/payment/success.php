<!-- <style>
   label {
  position: relative;
  height: 125px;
  width: 125px;
  display: inline-block;
  border: 2px solid rgba(255,255,255,0.2);
  border-radius: 50%;
  border-left-color: #10ac84;
  animation: circleRotate 1.2s linear infinite;
}

label .check-icon {
  display: none;
}

label .check-icon:after {
  position: absolute;
  content: "";
  height: 56px;
  width: 28px;
  top: 50%;
  left: 28px;
  transform: scaleX(-1) rotate(135deg);
  border-top: 4px solid #10ac84;
  border-right: 4px solid #10ac84;
  transform-origin: left top;
  animation: check_icon 0.8s ease;
}

@keyframes circleRotate {
  50% {
    border-left-color: #1dd1a1;
  }
  75% {
    border-left-color: #4cd137;
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframe check_icon {
  0% {
    height: 0px;
    width: 0px;
    opacity: 1;
  }
  20% {
    height: 0px;
    width: 28px;
    opacity: 1;
  }
  40% {
    height: 56px;
    width: 28px;
    opacity: 1;
  }
  100% {
    height: 56px;
    width: 28px;
    opacity: 1;
  }
}

#check-control:checked ~ label .check-icon {
  display: block;
}

#check-control:checked ~ label {
  animation: none;
  border-color: #10ac84;
  transition: border 0.5s ease-out;
}

#check-control {
  display: none;
}
</style>


<section class="content">
   <div class="transactionComplete">
      <input type="checkbox" id="check-control" />
      <label for="check-control">
         <div class="check-icon"></div>
      </label>
   </div>
</section>

 -->

<style>
 .checkmark__circle {
  stroke-dasharray: 600;
  stroke-dashoffset: 600;
  stroke-width: 50;
  stroke-miterlimit: 20;
  stroke: #7ac142;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  margin: 10% auto;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 64;
  stroke-dashoffset: 64;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #7ac142;
  }
}


</style>
 <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
  <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
  <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
</svg>


<style>
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



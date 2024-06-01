<div class="left message d-flex align-items-center" style="margin-bottom: 10px;">
  <img src="{{ asset('assets/img/cutie_patootie.jpg') }}" alt="Avatar" class="img-profile rounded-circle mr-3" style="width: 45px; height: 45px;">
  <p class="mb-0">{{$message}}</p>
</div>

<style>
  .left.message {
    display: flex;
    align-items: center;
  }
  .img-profile {
    margin-right: 10px;
  }
  .left.message p {
    margin: 0;
  }
</style>
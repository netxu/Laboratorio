"use strict";

const changeInput = (id) => {
  const input = document.getElementById(id);
  manageError(input, 'error-empty', isEmpty(input.value));
}

const changeInputEmail = () => {
  changeInput('email');
  const input = document.getElementById('email');
  const validation = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(input.value))
  manageError(input, 'error-email', !validation);
  manageTooltip(input, 'error-email', !validation);
}

const changeInputPassword = () => {
  const input = document.getElementById('password');
  changeInput('password');
  manageError(input, 'error-password', input.value.length<4 || input.value.length>8);
  changeInputRepeatPassword();
}

const changeInputRepeatPassword = () => {
  const inputRepeat = document.getElementById('repeat-password');
  const inputPassword = document.getElementById('password');
  manageError(inputRepeat, 'error-repeat', inputRepeat.value !== inputPassword.value);
  changeInput('repeat-password');
}

const isEmpty = (value) => value === "";

const manageError = (input, errorClass, conditionError) => {
  const parent = input.parentNode;
  if(conditionError){
    parent.classList.add("error");
    parent.classList.remove("success");
    parent.querySelector('.error-message').classList.remove('show');
    parent.querySelector('.error-message.'+errorClass).classList.add('show');
  } else {
    parent.classList.remove("error");
    parent.classList.add("success");
    parent.querySelector('.error-message.'+errorClass).classList.remove('show');
  }

  const inputsSuccess = document.querySelectorAll('.inputContainer.success');
  const inputs = document.querySelectorAll('.inputContainer');
  console.log(inputsSuccess, inputs);
  if(inputs.length === inputsSuccess.length) {
    document.querySelector("#add").disabled = false;
  } else {
    document.querySelector("#add").disabled = true;
  }
}

const manageTooltip = (input, errorClass, conditionError) => {
  if(conditionError) {
    input.title="El correo "+input.value+" no tiene un formato correcto. Ejemplo: example@domain.es";
  } else {
    input.title="";
  }
}
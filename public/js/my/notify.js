$(document).ready(()=>{
    if (!document.querySelector(".list-alert-container")) {
        const listAlertContainer = document.createElement('div');
        listAlertContainer.classList.add('list-alert-container');
        document.body.appendChild(listAlertContainer)
    }
})

class GNotify {
    static alertSuccess(message) {
        const alertContainer = document.createElement('div')
        alertContainer.classList.add("alert-container")
        alertContainer.classList.add("alert-container-success")
        alertContainer.innerHTML = `
        <div class="alert-icon">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-body">
          <p>`+ message + `</p>
        </div>
        <div class="alert-x-container">
          <button type="button" class="alert-x">&#10005;</button>
        </div>
        <div class="alert-loader"></div>
      `;

        $('.list-alert-container').append(alertContainer);
        $(alertContainer).css('display', 'flex').show(300);

        setTimeout(() => {
            $(alertContainer).hide(300)
            $(alertContainer).remove()
        }, 2500)

        return alertContainer;
    }

    static alertError(message) {
        const alertContainer = document.createElement('div')
        alertContainer.classList.add("alert-container")
        alertContainer.classList.add("alert-container-error")
        alertContainer.innerHTML = `
        <div class="alert-icon">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-body">
          <p>`+ message + `</p>
        </div>
        <div class="alert-x-container">
          <button type="button" class="alert-x">&#10005;</button>
        </div>
        <div class="alert-loader"></div>
      `;

        $('.list-alert-container').append(alertContainer);
        $(alertContainer).css('display', 'flex').show(300);

        setTimeout(() => {
            $(alertContainer).hide(300)
            $(alertContainer).remove()
        }, 2500)
        return alertContainer;
    }
}
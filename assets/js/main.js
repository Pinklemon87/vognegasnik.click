document.addEventListener("DOMContentLoaded", function () {

    /* -------------------------- Mobile Menu ------------------------------ */
    const mobileDiv = document.querySelector('.mobile div');
    const mobileNav = document.querySelector('.mobile nav');
    const mobileNavUl = document.querySelector('.mobile nav ul');
    const mobileNavItems = document.querySelectorAll('.mobile ul a');

    if (mobileDiv && mobileNav && mobileNavUl && mobileNavItems) {
        mobileDiv.addEventListener('click', () => {
            mobileDiv.classList.toggle('active');
            mobileNav.classList.toggle('open');
            mobileNavUl.classList.toggle('show');
        });

        mobileNavItems.forEach((item, index) => {
            item.style.animationDelay = `.${index + 2}s`;
        });
    }
    /*-----------------------------------------------------------------------*/

    /* -------------------------- ALERT SYSTEM ------------------------------ */
    let alerts = document.querySelectorAll(".alert");
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = "height 0.2s, opacity 0.2s";
            alert.style.height = "0";
            alert.style.opacity = "0";
            setTimeout(function () {
                alert.remove();
            }, 400);
        }, 2000);
    });
    /*-----------------------------------------------------------------------*/
});

//open add product form
function toggleAddProductForm()
{
    let form = document.getElementById("addProduct");
    let addArticle = document.getElementById("addArticle");
    let handlerForm = document.getElementById("handlerForm");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    addArticle.style.display = (addArticle.style.display === "none" || addArticle.style.display === "") ? "none" : "none";
    handlerForm.style.display = (handlerForm.style.display === "none" || handlerForm.style.display === "") ? "none" : "none";
}
/*-----------------------------------------------------------------------*/

//open add article form
function toggleAddArticleForm()
{
    let form = document.getElementById("addArticle");
    let addProduct = document.getElementById("addProduct");
    let handlerForm = document.getElementById("handlerForm");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    addProduct.style.display = (addProduct.style.display === "none" || addProduct.style.display === "") ? "none" : "none";
    handlerForm.style.display = (handlerForm.style.display === "none" || handlerForm.style.display === "") ? "none" : "none";
}
/*-----------------------------------------------------------------------*/

//open update orders
function toggleHandlerForm()
{
    let form = document.getElementById("updateOrders");
    let addArticle = document.getElementById("addArticle");
    let addProduct = document.getElementById("addProduct");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    addArticle.style.display = (addArticle.style.display === "none" || addArticle.style.display === "") ? "none" : "none";
    addProduct.style.display = (addProduct.style.display === "none" || addProduct.style.display === "") ? "none" : "none";
}
/*-----------------------------------------------------------------------*/
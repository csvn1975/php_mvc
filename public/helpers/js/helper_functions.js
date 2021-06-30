function menuActive(mainId, subID) {
    let mainMenu = document.querySelector(mainId)
    let subMenu = document.querySelector(subID)
    
    if (mainMenu != undefined && subMenu != undefined) {
        mainMenu.classList.add('open');
        subMenu.classList.add('active');
    }
}

function setPaginationStatus(currentPage, pageCount){
    let pageLink = document.querySelectorAll(".page-item[data='number']");
    let pagePrevious = document.querySelector(".page-item[data='prev']");
    let pageNext = document.querySelector(".page-item[data='next']");

    if (currentPage == 1) {
        pagePrevious.classList.add('disabled')
    } 
    else if (currentPage == pageCount)
    {
        pageNext.classList.add('disabled') 
    }
    pageLink[currentPage-1].classList.add('active')
}
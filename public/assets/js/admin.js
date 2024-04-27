 // Mở menu ở màn hình điện thoại

 var barMenu = document.querySelector('#bar-menu')
 var btnClose = document.querySelector('.btn-close')
 var menuSmartPhone = document.querySelector('#header .header__item--3')
 barMenu.addEventListener('click', () => {
   menuSmartPhone.style.right = '0'
 })
 btnClose.addEventListener('click', () => {
   menuSmartPhone.style.right = '-245px'
 })


 // ẩn hiện menu cấp 2 ở màn hình smartphone
 var smMenuLevel2 = document.querySelector('#sm-level-2')
 var smMenuLevel2Ul = document.querySelector('#sm-level-2 ul')
 var inputSearchMini = document.querySelector('.inputSearchMini')
 smMenuLevel2.addEventListener('click', () => {
   setTimeout(function () {
     if (smMenuLevel2.classList.toggle('active')) {
       smMenuLevel2Ul.style.display = 'block'
       inputSearchMini.style.marginTop = '80px'
     } else {
       smMenuLevel2Ul.style.display = 'none'
       inputSearchMini.style.marginTop = '0'
     }
   }, 400)
 })

 var titleListPostFeature = document.querySelectorAll(
   '#my-content .list-post-with-feature .post-with-feature-item .post-with-feature-item__title__time .post-with-feature-item__title__time--title'
 )
 titleListPostFeature.forEach((item) => {
   if (item.innerHTML.length > 98) {
     var strNew = item.innerHTML.slice(0, 98) + '...'
     item.innerHTML = strNew
   }
 })

 var desc_post_features = document.querySelectorAll(
   '.post-feature-item .post-feature-item__desc p'
 )
 desc_post_features.forEach((item) => {
   if (item.innerHTML.length > 240) {
     var strNew = item.innerHTML.slice(0, 240) + '...'
     item.innerHTML = strNew
   }
 })


 const handleSidebarLeft = () => {
    var menuSetting = document.querySelector('.setting-menu button')
    var menuSettingSub = document.querySelector('#sidebar-left .setting-submenu')
    var menuSettingItem = document.querySelector('.setting-menu span')
    menuSetting.addEventListener('click', () => {
      
      if (menuSetting.classList.toggle('active')) {
        menuSettingSub.style.display = 'block'
      
        menuSettingItem.innerHTML = '<i class="bi bi-caret-up-fill">'
      } else {
        menuSettingSub.style.display = 'none'
        
        menuSettingItem.innerHTML = '<i class="bi bi-caret-down-fill">'
      }
    })
  }

  handleSidebarLeft()
const userInfo = document.getElementById('user_info')


const cookies = getCookies(document.cookie)

if (!cookies['CookieUser'] || cookies['CookieUser'] === '') {
    window.location.href = "/login.php"
}
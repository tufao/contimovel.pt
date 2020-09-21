
var cookiesBanner = new CookiesEuBanner(function () {
    /* Example: your Google Analytics script
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-XXXXXXXX-X', 'auto');
    ga('send', 'pageview');
    */
    console.log("LOAD GA");
}, true);

function updateCookiesEuState() {
    var hasConsent = cookiesBanner.hasConsent()
    var state = '❔ Nor accepted nor rejected';

    if (hasConsent === true) {
    state = '✅ Accepted';
    } else if (hasConsent === false) {
    state = '❌ Rejected';
    }

    document.getElementById('cookies-eu-state').innerText = state;
}
updateCookiesEuState();
setInterval(updateCookiesEuState, 100);

// Prefer use addEventListener
// For demo purpose I will use the CookiesEuBanner internal method
cookiesBanner.addClickListener(document.getElementById('custom-accept'), function () {
    cookiesBanner.setConsent(true);
    cookiesBanner.removeBanner();
    updateCookiesEuState();
});
cookiesBanner.addClickListener(document.getElementById('custom-reject'), function () {
    cookiesBanner.setConsent(false);
    cookiesBanner.removeBanner();
    updateCookiesEuState();
});
cookiesBanner.addClickListener(document.getElementById('custom-reset'), function () {
    cookiesBanner.deleteCookie(cookiesBanner.cookieName);
    window.location.reload();
});

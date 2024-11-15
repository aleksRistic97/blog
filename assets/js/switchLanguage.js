function switchLanguage(language) {
    const currentUrl = window.location.href;

    if (language === 'sr') {

        window.location.href = currentUrl.replace(/\/(en|sr)\//, '/sr/');
    }


    if (language === 'en') {

        window.location.href = currentUrl.replace(/\/(en|sr)\//, '/en/');
    }
}

window.switchLanguage = switchLanguage;
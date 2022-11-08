function setLocale(locale) {
    Cookies.set('locale', locale);
    window.location.reload();
}
const getHost = () => { 
    const path = window.location.pathname;
    const folderName = path.split('/')[1];
    return  folderName;
}
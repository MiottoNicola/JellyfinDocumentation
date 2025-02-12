# 404 Error Page

This repository contains a JSON to HTML converter of the Jellyfin web service API.

### Usage

1. Clone the repository:
    ```sh
    git clone https://github.com/MiottoNicola/JellyfinDocumentation.git
    ```

2. Copy the `404.html` file to the root directory of your website.

3. Configure your web server to use `404.html` as the 404 error page. For example, for an Apache server, add the following line to the `.htaccess` file:
    ```
    ErrorDocument 404 /404.html
    ```
    
### Note
If the Jellyfin APIs are updated in the future, it is possible to replace the JSON format file with the new file by downloading it from the [official Jellyfin page](https://jellyfin.org).

### Contributing

If you would like to contribute to this project, feel free to fork the repository and submit a pull request with your changes.

### License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

# Helium CSS module for Prestashop 1.6+

## Description

[Helium](https://github.com/geuis/helium-css) is a tool for discovering unused CSS across many pages on a web site.

The tool is javascript-based and runs from the browser.

Helium accepts a list of URLs for different sections of a site then loads and parses each page to build up a list of all stylesheets. It then visits each page in the URL list and checks if the selectors found in the stylesheets are used on the pages. Finally, it generates a report that details each stylesheet and the selectors that were not found to be used on any of the given pages.

This module read your sitemap.xml of your shop and build a list of URLs for Helium.

##### Note: You really should only run Helium on a local, development, or otherwise privately accessible version of your site. If you run this on your public site, every visitor will see the Helium test environment.

#####  PLEASE READ THE "IMPORTANT STUFF" SECTION BELOW!!

### Installation

Download the [lastest release](https://github.com/Benichou34/helium/releases/latest) and install it.

For more details, see [How to install a module on PrestaShop](http://addons.prestashop.com/en/content/21-how-to).

### Usage

1. Go to the configuration page of your Google sitemap module, indicate the pages that you do NOT want to check with Helium and generate the Sitemaps file. You can modify this list if you want to add or remove URLS.

2. Once Helium is activated, when you load your site you will see a box with a textarea filled with your sitemap URLs.

3. Click Start (lower left) to begin the process. Clicking "Reset to Beginning" clears the textarea and stored data.

4. The test will proceed to load and process each url you gave. When it is finished, you are presented with a report window that lists each stylesheet URL that was detected. Under each stylesheet, it will list the CSS selectors that were not detected to be in use on any page.

5. The selectors are color-coded.

   * ##### Green: Unmatched selectors.
   	These are the primary ones that were not detected as in-use.

   * ##### Black: Matched selectors that are grouped with non-matched selectors.
   	Basically this means that multiple selectors were defined together like "h1,h2,h3{}". All selectors are tested individually so these are displayed to make them easier to find in the stylesheets later.

   * ##### Red: Malformed selectors.
   	These are likely to be rare. This means that when the browser tried testing for a selector, it can't parse the syntax of how it was written. This could be like ".classname# idname{}" or a "CSS hack" often used for Internet Explorer.

   * ##### Blue: Pseudo-class selector.
  	These are selectors like ".div:hover" or "input:focus". These are selectors that require user interaction to activate. Currently, Helium can't simulate the interactions required to see if these are found or not. It is the developer's responsibility to test for these manually.

### Browser Support:

Any modern browser that supports LocalStorage and document.querySelector.

Helium not support IE6 or 7.

### IMPORTANT STUFF:
1. No cross-domain stylesheets: Helium has to load the stylesheets on your site via XHR in order to parse out the selectors to test. This means that all stylesheets URLs have to be on the same domain as the pages being tested. There's currently no back-end server to proxy requests, but this might be an option in the future.

2. No javascript errors on your pages: If Helium is run on a page that has one or more javascript errors, it can easily prevent Helium and other scripts from running on the page. This will stop your tests dead in their tracks. Verify ahead of time that all of the URLs you are testing do not generate any javascript errors. If you aren't sure, try running some Helium tests and see what page it stops at. Check out your error consoles on such pages.

3. No CDN hosted support : If you would like to use a CDN hosted version of Helium, see https://cdnjs.com/libraries/helium-css.

## Contributing

This module is an open-source extension to the PrestaShop e-commerce solution. Everyone is welcome and even encouraged to contribute with their own improvements.
Please follow [the coding standards](http://doc.prestashop.com/display/PS16/Coding+Standards).

## License

This module is licensed under the [MIT License](http://opensource.org/licenses/MIT).
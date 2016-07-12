# pagekit-template-generator

### Right now Pagekit does not have support for 3rd party console extensions, [I've made a pull request here asking for this feature.](https://github.com/pagekit/pagekit/pull/703) Until then, this extension will not work on Pagekit right now without merging that request.

The generator makes everything needed to start creating a Pagekit extension, from the Database scripts file, to Webpack and Vue.js ( just run `npm install` then `webpack` in the created extension directory )
*tip: `webpack -w` will watch any files for changes and automatically run webpack*

![pagekit-extension-generator](https://cloud.githubusercontent.com/assets/9405969/16783923/a02915e4-4843-11e6-89d5-c2392df98b0e.gif)

Some things like the comments in the index.php file and using the progress bar I got from a [pull request to Pagekit adding in an a 'built in' extension generator](https://github.com/pagekit/pagekit/pull/468).

#### Basic usage
`php pagekit generate:extension {{ vendor_name }}/{{ module_name }}`
`php pagekit generate:extension hello/world`

#### Adding in file permission mode
`php pagekit generate:extension hello/world 777`

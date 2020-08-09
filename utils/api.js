const protocol = "http";
const host = "api.jcycms.com.cn";
const modules = 'v1';// v1 or rest
const urlPreFix = `${protocol}://${host}/${modules}`;
let config = {};
if (modules !== 'rest') {
  config = {
    host,
    login: `${urlPreFix}/access-user/login`,
    logout: `${urlPreFix}/user/logout`,
    article: `${urlPreFix}/article/index`,
    articleDetail: `${urlPreFix}/article/view`
  };  
} else {
  config = {
    host,
    login: `${urlPreFix}/access-user/login`,// POST
    logout: `${urlPreFix}/user/logout`,// GET
    article: `${urlPreFix}/articles`,// GET
    articleDetail: `${urlPreFix}/articles/ID`,//GET
  };
}

module.exports = config;

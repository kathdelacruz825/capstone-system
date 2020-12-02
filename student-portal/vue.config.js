module.exports = {
  publicPath:
    // process.env.NODE_ENV === "production" ? "/studentportal.github.io/" : "/",
    process.env.NODE_ENV === "production" ? "/studentportal/" : "/",

  devServer: {
    // proxy: "http://localhost/studentportal-server"
  }
};

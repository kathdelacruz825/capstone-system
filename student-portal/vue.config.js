module.exports = {
  publicPath: process.env.NODE_ENV === "production" ? "/studentportal.github.io/" : "/",
  devServer: {
    // proxy: "http://localhost/pos-web-server"
  }
};

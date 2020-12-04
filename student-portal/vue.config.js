module.exports = {
  publicPath:
    process.env.NODE_ENV === "production" ? "/studentportal.github.io/" : "/", //domain
  // process.env.NODE_ENV === "production" ? "/studentportal/" : "/", // localhost

  devServer: {
    // proxy: "http://localhost/studentportal-server"
  }
};

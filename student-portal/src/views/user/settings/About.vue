<template>
  <div class="about">
    <Nav :title="'About'" :isLeftArrow="true" :isRightText="false" />
    <div class="columns-inner">
      <div class="column-center-outer">
        <div class="column-center-inner">
          <div class="main section" id="main" name="Main" style="padding: 10px">
            <div class="widget Blog" data-version="1" id="Blog1">
              <div class="blog-posts hfeed">
                <div class="date-outer">
                  <div class="date-posts">
                    <div class="post-outer">
                      <div
                        class="post hentry uncustomized-post-template"
                        itemscope="itemscope"
                        itemtype="http://schema.org/BlogPosting"
                      >
                        <meta
                          content="http://4.bp.blogspot.com/-LU14zEjoCPY/UBPBR4yp79I/AAAAAAAAAEU/vyHgl3Qd6gk/s72-c/389279_476143619068635_442952810_a.jpg"
                          itemprop="image_url"
                        />
                        <meta content="7906335373325221722" itemprop="blogId" />
                        <meta content="2959315329400765009" itemprop="postId" />
                        <a name="2959315329400765009"></a>
                        <div class="post-header">
                          <div class="post-header-line-1"></div>
                        </div>
                        <div
                          class="post-body entry-content"
                          id="post-body-2959315329400765009"
                          itemprop="articleBody"
                        >
                          <div
                            class="separator"
                            style="clear: both; text-align: center;"
                          >
                            <img
                              border="0"
                              height="280"
                              style="margin: 0 auto;"
                              src="http://4.bp.blogspot.com/-LU14zEjoCPY/UBPBR4yp79I/AAAAAAAAAEU/vyHgl3Qd6gk/s280/389279_476143619068635_442952810_a.jpg"
                              width="280"
                            />
                          </div>
                          <br />
                          <div style="text-align: center;"></div>
                          <div class="MsoNormal">
                            <span
                              style="font-family: 'Lucida Calligraphy'; font-size: 18pt; line-height: 115%;"
                              >La Salette Of Aurora
                            </span>
                          </div>
                          <br />
                          &nbsp; &nbsp;
                          <span
                            style="color: #134f5c; font-family: 'Trebuchet MS', sans-serif;"
                            >History:</span
                          ><br />
                          <br />
                          <div style="text-align: justify;">
                            ^^La Salette of Aurora, Inc., one among the eight La
                            Salette schools in the province of Isabela, is
                            located in Brgy. Sta. Rosa, Aurora, Isabela,
                            Philippines - a town west of Cabatuan across the
                            ravaging Magat River which continually erodes the
                            town's border taking&nbsp;away&nbsp;big portion of
                            farm lands.
                          </div>
                          <div style="text-align: justify;">
                            <br />
                          </div>

                          <div style="text-align: justify;">
                            &nbsp; &nbsp; In 1952, the late Rev. Fr. Paul
                            Doulliard, MS who was the Parish Priest of St.
                            Isidore Parish, thought of putting up a school for
                            Catholic families' children in the Parish. His
                            missionary spirit inspired him so much that he
                            requested the Bishop for an approval. Not long
                            later, the awaited Bishop's approval reached his
                            hands in exchange for his prayers,&nbsp;sacrifices,
                            inspiration and love for the Catholic families.
                          </div>
                          <div style="text-align: justify;">
                            <br />
                          </div>

                          <div style="text-align: justify;">
                            &nbsp; &nbsp; By March 1952, La Salette of Aurora
                            was incorporated as a non-stock, non-profit
                            institution with the purpose of providing secondary
                            education. On July 1, 1952, the school started its
                            operation with a total&nbsp;enrollment&nbsp;of 193
                            students of 376. Since then, it continues to cater
                            to the educational needs of the Western part of
                            Isabela particularly Burgos, San Manuel, and Aurora.
                            During the&nbsp;succeeding&nbsp;years of operation,
                            the school finally won the&nbsp;recognition&nbsp;of
                            of the Ministry of Education and Culture formerly
                            Department of Education. Now, La Salette of Aurora
                            has finally come of age. The&nbsp;future&nbsp;looks
                            brighter still.
                          </div>
                          <div style="text-align: justify;">
                            <br />
                          </div>

                          &nbsp; &nbsp;<span
                            style="font-family: 'Trebuchet MS', sans-serif;"
                          >
                            <span style="color: #0c343d;"
                              >The School's Vision:</span
                            ></span
                          ><br />
                          <br />
                          ^^La Salette School System is a community of catholic
                          schools called to evangelize the young in the spirit
                          of Our Lady of La Salette's message of
                          Reconciliation.^^<br />
                          <br />
                          &nbsp; &nbsp;
                          <span
                            style="color: #0c343d; font-family: 'Trebuchet MS', sans-serif;"
                            >Mission:</span
                          ><br />
                          <br />
                          ^^To provide excellent catholic education, to enable
                          the young to attain "fullness of life".^^<br />
                          <br />
                          &nbsp; &nbsp;
                          <span
                            style="color: #0c343d; font-family: 'Trebuchet MS', sans-serif;"
                            >Core Values:</span
                          ><br />
                          <br />
                          1.) Mary's Fiat<br />
                          2.) Prayer, Penance and Zeal<br />
                          3.) Excellence<br />
                          4.) Solidarity<br />
                          5.) Stewardship
                          <div style="clear: both;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="column-left-outer">
        <div class="column-left-inner">
          <aside></aside>
        </div>
      </div>
      <div class="column-right-outer">
        <div class="column-right-inner">
          <aside></aside>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "About",
  components: {
    Nav
    // Footer
  },
  data() {
    return {};
  },
  methods: {},
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>

<template>
  <div class="single-post-example">
    <a href="" onclick="history.back()">BACK</a>
    <h1>Post have no content!</h1>

  </div>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
  .post-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0 24px;
    max-width:1440px;
    margin:32px auto 0;
  }
  .post-content {
    flex-grow:2;
    display: flex;
    flex-direction: column;
  }
  .post-content nav {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }
  .post-content nav a {
    color:#BDBDBD;
    font-size: 18px;
  }
  .post-content h1 {
    color:#333333;
    margin-bottom: 16px;
  }
  .post-meta {
    display: flex;
    margin-bottom: 16px;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
  .post-meta .info a,
  .post-meta .info {
    color:#333;
    font-size: 16px;
  }
  .post-meta .info .author {
    padding-right: 4px;
    margin-right: 4px;
    border-right: 1px solid #333;
  }
  .post-content section {
    margin-bottom: 16px;
  }
  .post-content {
    color:#333;
  }
  section h2 {
    padding-right: 6px;
    border-right: 5px solid #F2C94C;
  }
  section.image img {
    max-width: 100%;
    object-fit: cover;
    margin-bottom: 12px;
  }
  section.imageWithText img {
    max-width:50%;
  }
  section.imageWithText img.right {
    float:right;
    margin-left: 16px;
  }
  section.imageWithText img.left {
    float:left;
    margin-right: 16px;
  }
  section.imageWithText h2 {
    color:#333;
    margin-bottom: 16px;
  }
  section.video iframe {
    width:100%;
    height:450px;
  }
  section.image p {
    font-size: 16px;
  }
  section.image p:last-child {
    margin-bottom: 0;
  }
  section.text p {
    /* margin-bottom: ; */
    color:#4F4F4F;
    font-size: 18px;
  }
  section.text p:last-child {
    margin-bottom: 0;
  }
  section.sub-title h2 {
    margin-bottom: 0;
    color:#333;
    font-size: 36px;
  }
  section.survey {
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    padding:24px;
  }
  section.survey > div {
    max-width: 550px;
  }
  .opinion {

  }
  .post-content section:last-of-type {
    padding-bottom: 32px;
    /* margin-top: 32px; */
    border-bottom: 1px solid #BDBDBD;
  }
  .img-subtext {
    max-width: 600px;
    color:#333;
    font-style: italic;
    margin-bottom: 0;
  }
  .related-posts {
    width: 100%;
    padding:0 24px;
  }
  .related-post {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    margin-top: 24px;
  }
  .related-post {
    text-decoration: none;
  }
  .related-post a {
    text-decoration-color: #333;
  }
  .related-post h3 {
    color:#333;
    text-decoration-color: #333;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
  }
  .related-post-content {
    padding-right: 16px;
    color:#333333;
    padding-left: 16px;
  }
  .related-post-meta {
    color:#333;
    display:flex;
    align-items: center;
    justify-content: flex-start;
    flex-direction: row;
    white-space: nowrap;
    font-size: 14px;
    margin-bottom: 8px;
  }
  .related-post-meta .author {
    padding-right: 4px;
    margin-right: 4px;
    border-right: 1px solid #333;
  }
  .related-post-content .excerpt {
    color:#828282;
    font-size: 16px;
  }
  .share {
    color:#333333;
    text-decoration-color:#333333;

  }
  @media (max-width:1024px) {
    .post-wrapper {
      flex-direction: column;
    }
  }
  @media (max-width:768px) {
    .post-content h1 {
      font-size: 32px;
      line-height: 32px;
    }
    section.imageWithText img.left,
    section.imageWithText img.right {
      float:none;
      margin-right: 0;
      max-width: unset;
    }
  }
  @media (max-width:550px) {
    .related-post {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .related-post-meta {
      justify-content: center;
    }
    .related-post img {
      margin-bottom: 8px;
    }
    section.survey {
      padding:12px 4px;
    }
    .post-wrapper {
      padding:0 8px;
    }
    .related-post-content {
      padding:0 4px;
    }
    .related-post-content .excerpt {
      text-align: center;
    }
    .related-post h3 {
      font-size: 18px;
      line-height: 18px;
    }
    .post-content h1 {
      font-size: 28px;
      line-height: 28px;
    }
  }
</style>

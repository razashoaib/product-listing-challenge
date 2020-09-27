import React, { useEffect, useState } from "react";
import axios from "axios";
import Dialog from "@material-ui/core/Dialog";
import MuiDialogContent from "@material-ui/core/DialogContent";
import Constants from "../common/constants";
import CircularProgress from "@material-ui/core/CircularProgress";

const ProductVideoPreview = ({ closed, isOpen, productId }) => {
  const [videoUrl, setVideoUrl] = useState("");

  const handleClose = () => {
    closed();
    setVideoUrl("");
  };

  const getProductPreviewVideoUrl = async (url) => {
    try {
      const response = await axios.get(url);

      setVideoUrl(
        response.data.videos_url.length > 0
          ? response.data.videos_url[0].url
          : "https://dm0qx8t0i9gc9.cloudfront.net/watermarks/video/qEue9C6/videoblocks-lost-and-found-magnifying-glass-search-find-missing-item-words-3-d-animation_rgfetrayu__ef374877b741ebde7318ef438566473a__P360.mp4"
      );
    } catch (err) {
      console.log("error while making api request");
      console.log(err);
    }
  };

  useEffect(() => {
    if (productId !== "" && isOpen) {
      getProductPreviewVideoUrl(
        `${Constants.BASE_URL}/products/${productId}/videos`
      );
    }
  }, [isOpen]);

  return (
    <div>
      <Dialog
        onClose={handleClose}
        aria-labelledby="customized-dialog-title"
        open={isOpen}
      >
        <MuiDialogContent dividers>
          {videoUrl !== "" ? (
            <video width="500" height="500" controls>
              <source src={videoUrl} type="video/mp4" />
              Your browser does not support the video tag.
            </video>
          ) : (
            <CircularProgress />
          )}
        </MuiDialogContent>
      </Dialog>
    </div>
  );
};

export default ProductVideoPreview;

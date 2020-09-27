import React from "react";
import { makeStyles, withStyles } from "@material-ui/core/styles";
import InputLabel from "@material-ui/core/InputLabel";
import MenuItem from "@material-ui/core/MenuItem";
import FormControl from "@material-ui/core/FormControl";
import Select from "@material-ui/core/Select";
import InputBase from "@material-ui/core/InputBase";
import ArrowBackSharpIcon from "@material-ui/icons/ArrowBackSharp";
import ArrowForwardSharpIcon from "@material-ui/icons/ArrowForwardSharp";
import { Button } from "@material-ui/core";

const BootstrapInput = withStyles((theme) => ({
  root: {
    "label + &": {
      marginTop: theme.spacing(3),
    },
  },
  input: {
    borderRadius: 4,
    width: "65px",
    position: "relative",
    backgroundColor: theme.palette.background.paper,
    border: "1px solid #ced4da",
    fontSize: 16,
    padding: "10px 26px 10px 12px",
    transition: theme.transitions.create(["border-color", "box-shadow"]),
    "&:focus": {
      borderRadius: 4,
      borderColor: "#80bdff",
      boxShadow: "0 0 0 0.2rem rgba(0,123,255,.25)",
    },
  },
}))(InputBase);

const useStyles = makeStyles((theme) => ({
  margin: {
    margin: theme.spacing(1),
  },
  buttonWithIconAndText: {
    marginTop: "25px",
  },
  iconButton: {
    marginTop: "17px",
  },
}));

export default function Filters({
  genderChangeCallback,
  pageSizeChangeCallback,
  pageNumberChangeCallback,
  currentPage,
  lastPage,
}) {
  const classes = useStyles();
  const [gender, setGender] = React.useState("male");
  const [pageSize, setPageSize] = React.useState(30);

  const handlePageSizeChange = (event) => {
    setPageSize(event.target.value);
    pageSizeChangeCallback(event.target.value);
  };

  const handleGenderChange = (event) => {
    setGender(event.target.value);
    genderChangeCallback(event.target.value);
  };

  const handlePrevPageClick = (event) => {
    pageNumberChangeCallback(currentPage - 1);
  };

  const handleNextPageClick = (event) => {
    pageNumberChangeCallback(currentPage + 1);
  };

  return (
    <div>
      <FormControl className={classes.margin}>
        <InputLabel id="demo-customized-select-label">Gender</InputLabel>
        <Select
          labelId="demo-customized-select-label"
          id="demo-customized-select"
          onChange={handleGenderChange}
          value={gender}
          input={<BootstrapInput />}
        >
          <MenuItem value="male">Male</MenuItem>
          <MenuItem value="female">Female</MenuItem>
        </Select>
      </FormControl>
      <FormControl className={classes.margin}>
        <InputLabel id="demo-customized-select-label">Page Size</InputLabel>
        <Select
          labelId="demo-customized-select-label"
          id="demo-customized-select"
          value={pageSize}
          onChange={handlePageSizeChange}
          input={<BootstrapInput />}
        >
          <MenuItem value={10}>10</MenuItem>
          <MenuItem value={30}>30</MenuItem>
          <MenuItem value={50}>50</MenuItem>
          <MenuItem value={100}>100</MenuItem>
        </Select>
      </FormControl>
      <FormControl className={classes.margin}>
        <Button
          disabled={currentPage === 1}
          variant="contained"
          color="default"
          className={classes.buttonWithIconAndText}
          startIcon={<ArrowBackSharpIcon />}
          onClick={handlePrevPageClick}
        >
          Prev Page
        </Button>
      </FormControl>
      <FormControl className={classes.margin}>
        <Button
          disabled={currentPage === lastPage}
          variant="contained"
          color="default"
          className={classes.buttonWithIconAndText}
          startIcon={<ArrowForwardSharpIcon />}
          onClick={handleNextPageClick}
        >
          Next Page
        </Button>
      </FormControl>
    </div>
  );
}

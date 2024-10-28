function addComment()
{
    document.getElementById('special_style1').addEventListener( 'click', function () {

        var commentForm=document.getElementById('new_comment_container');

        if(commentForm.style.display === 'none')
        {

            commentForm.style.display='block'
        }
        else
        {

            commentForm.style.display='none'
        }
    })

}